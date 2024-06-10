<?php

namespace plugins\superpms\login;

use plugins\superpms\authority\AuthorityAction;
use pms\app\Middleware;
use pms\app\Plugins;
use pms\facade\Path;

/**
 * PMS 登录认证中间件
 */
class LoginAuthMiddleware extends Middleware
{
    use Plugins;

    protected array $config = [];

    public function handle(): void
    {
        if ($this->class->hasProperty('login')) {
            $login = $this->class->getProperty('login');
            if ($login->hasDefaultValue()) {
                $this->login($login->getDefaultValue());
            }
        }

    }

    protected function login($login): void
    {
        $expireTime = (int)$this->request->header(self::config('header-expire-time', 'x-expire-time'), '');
        $userid = $this->request->header(self::config('header-userid', 'x-id'), '');
        $token = $this->request->header(self::config('header-token', 'x-token'), '');
        $app = $this->request->header(self::config('header-app', 'x-app'), '');
        $rAuthority = $this->request->header(self::config('header-authority', 'x-authority'), null);
        if ($login === LOGIN_FALSE) {
            $this->request->setAttach('userinfo', 0);
            return;
        }
        if ($userid === '' || $token === '' || $app == '') {
            if ($login === LOGIN_OR) {
                $this->request->setAttach('userinfo', 0);
                return;
            } else {
                throw new LoginAuthException('未登录');
            }
        }
        if ($app !== $this->app) {
            throw new LoginAuthException('未登录');
        }
        $userid = LoginAction::idUnShifting($userid);
        $realToken = LoginAction::loginAuthSignature($expireTime, $userid, $app, $rAuthority);
        if ($realToken !== $token) {
            if ($login === LOGIN_OR) {
                $this->request->setAttach('userinfo', 0);
                return;
            }
            throw new LoginAuthException('未登录');
        }
        if ($expireTime !== 0 && $expireTime < time()) {
            throw new LoginAuthException('登录状态已失效');
        }
        $this->request->setAttach('userinfo', (int)$userid);

        // 登录后验证访问权限
        if ($this->class->hasProperty('authority')) {
            $authority = $this->class->getProperty('authority');
            if ($authority->hasDefaultValue()) {
                $authority = $authority->getDefaultValue();
                if (!empty($authority)) {
                    $this->authority($authority,$rAuthority);
                }
            }
        }
    }

    protected function authority(string $authority,$rAuthority){
        if (empty($rAuthority)) {
            throw new AuthorityAuthException("暂无权限");
        }

        $rAuthority = LoginAction::idUnShifting($rAuthority);
        $transform = self::config('authority-transform', function ($authority) {
            return $authority;
        });
        if (!($transform instanceof \Closure)) {
            throw new AuthorityAuthException("权限配置错误");
        }
        $app = $this->app;
        $file = Path::getApp("$app/authority.xml");
        if (!is_file($file)) {
            throw new AuthorityAuthException("权限配置不存在");
        }
        $data = $transform($rAuthority);
        dd($data);


//        dd($rAuthority, $rAuthorityToken);
//        dd($this->app);
    }

}