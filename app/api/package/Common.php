<?php

namespace app\api\package;


use pms\annotate\Inject;
use pms\app\Http;
use pms\app\inject\http\RequestInject;
use pms\app\inject\http\SafeParamsInject;

abstract class Common extends Http
{
    protected string $login = LOGIN_TRUE;

    protected bool $token = true;

    protected array|string $terminal = [];


    #[Inject(SafeParamsInject::class)]
    protected SafeParamsInject $safeParams;

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