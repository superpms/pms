<?php

namespace plugins\superpms\auth\middleware;
use app\api\exception\AuthException;
use plugins\superpms\auth\action\AuthAction;
use plugins\superpms\auth\exception\LoginAuthException;
use pms\app\Middleware;
use pms\app\Plugins;

/**
 * PMS 登录认证中间件
 */
class LoginAuthMiddleware extends Middleware{
    use Plugins;
    protected array $config = [];
    public function handle(): void{
        if($this->class->hasProperty('login')){
            $login = $this->class->getProperty('login')->getDefaultValue();
            $this->login($login);
        }
    }

    protected function login($login): void{
        $userid = $this->request->header(self::config('header-userid','x-id'),'');
        $token = $this->request->header(self::config('header-token','x-token'),'');
        $time = $this->request->header(self::config('header-time','x-time'),'');
        $lastTime = $this->request->header(self::config('header-last-time','x-last-time'),'');
        if($userid === '' || $token === '' || $time === '' || $lastTime === ''){
            if($login === LOGIN_FALSE || $login === LOGIN_OR){
                $this->request->setAttach('userinfo',0);
                return;
            }else{
                throw new LoginAuthException('未登录');
            }
        }
        $realToken = AuthAction::loginAuthSignature((int)$time,(int)$lastTime,$userid);
        if($realToken !== $token){
            throw new LoginAuthException('未登录');
        }
        $userid = AuthAction::idUnShifting($userid);
        $this->request->setAttach('userinfo',(int)$userid);
    }

}