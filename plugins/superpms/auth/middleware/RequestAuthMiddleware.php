<?php

namespace plugins\superpms\auth\middleware;
use plugins\superpms\auth\action\AuthAction;
use plugins\superpms\auth\exception\RequestAuthException;
use pms\app\Middleware;
use pms\app\Plugins;

/**
 * PMS 请求认证中间件
 */
class RequestAuthMiddleware extends Middleware{
    use Plugins;
    protected array $config = [];
    public function handle(): void{
        if($this->class->hasProperty('token')){
            $token = $this->class->getProperty('token')->getDefaultValue();
            if($token){
                $this->token();
            }
        }
    }

    protected function token(): void{
        $rTime = $this->request->header(self::config('header-request-time','x-request-time'));
        $rToken = $this->request->header(self::config('header-request-token','x-request-token'));
        $effectTime = self::config('request-time',0);
        if($effectTime === 0){
            return;
        }
        if(empty($rToken)){
            throw new RequestAuthException("请求验证失败");
        }else{
            $realToken = AuthAction::requestAuthSignature($rTime);
            if($rToken !== $realToken || (time() - $rTime > $effectTime)){
                throw new RequestAuthException("请求验证失败");
            }
        }
    }

}