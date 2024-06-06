<?php

namespace app\api;


use pms\annotate\Inject;
use pms\app\Http;
use pms\app\inject\http\RequestInject;
use pms\app\inject\http\SafeParamsInject;

abstract class Package extends Http
{
    /**
     * 【插件:superpms/auth】登录状态检测中间件
     * @package plugins\superpms\auth\middleware\LoginAuthMiddleware
     * @var int 是否进行登录状态检测
     */
    protected int $login = LOGIN_FALSE;

    /**
     * 【插件:superpms/auth】接口请求签名检测中间件
     * @package plugins\superpms\auth\middleware\RequestAuthException
     * @var bool 是否进行请求签名检测
     */
    protected bool $token = false;

    /**
     * 依赖注入
     * @var SafeParamsInject 当前接口安全参数
     */
    #[Inject(SafeParamsInject::class)]
    protected SafeParamsInject $safeParams;

    /**
     * 依赖注入
     * @var RequestInject 当前接口请求对象
     */
    #[Inject(RequestInject::class)]
    protected RequestInject $request;

    public function back(mixed $data): void
    {
        $this->responseData = $data;
    }

    public function success(mixed $data, $code = 200, array $other = []): mixed
    {
        $this->responseData = [
            'data' => $data,
            'code' => $code,
        ];
        if(!empty($other)){
            $this->responseData['other'] = $other;
        }
        return $this->responseData;
    }

    public function error(mixed $message, $code = 500, array $other = []): mixed
    {
        $this->responseData = [
            'message' => $message,
            'code' => $code,
        ];
        if(!empty($other)){
            $this->responseData['other'] = $other;
        }
        return $this->responseData;
    }

    public function return(mixed $message)
    {
        $this->responseData = $message;
        return $this->responseData;
    }

}