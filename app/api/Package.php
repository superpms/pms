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
     * @package  \plugins\superpms\auth\login\LoginAuthMiddleware
     * @var int 是否进行登录状态检测
     */
    protected int $login = LOGIN_FALSE;

    /**
     * 【插件:superpms/auth】接口请求签名检测中间件
     * @package  \plugins\superpms\auth\request\RequestAuthMiddleware
     * @var bool 是否进行请求签名检测
     */
    protected bool $token = false;

    /**
     * 【插件:superpms/auth】权限检测中间件
     * @package plugins\superpms\auth\authority\authorityMiddleware
     * @var string|array 权限标识
     */
    protected string|array $authority = [];


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

    public function success(mixed $data, array $other = []): mixed
    {
        $this->responseData = [
            'data' => $data,
            'code' => 200,
        ];
        if(!empty($other)){
            $this->responseData = [
                ...$this->responseData,
                ...$other
            ];
        }
        return $this->responseData;
    }

    public function error(mixed $message, $code = 300, array $other = []): mixed
    {
        $this->responseData = [
            'message' => $message,
            'code' => $code,
        ];
        if(!empty($other)){
            $this->responseData = [
                ...$this->responseData,
                ...$other
            ];
        }
        return $this->responseData;
    }

    public function return(mixed $message)
    {
        $this->responseData = $message;
        return $this->responseData;
    }

    protected function params(string $key=null, $default = null): array|string|null
    {
        return $this->request->params($key, $default);
    }

    protected function safe(string $key=null, $default = null): array|string|null
    {
        return $this->safeParams->get($key, $default);
    }

}