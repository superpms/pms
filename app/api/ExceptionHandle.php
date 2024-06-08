<?php

namespace app\api;

use plugins\superpms\auth\exception\LoginAuthException;
use plugins\superpms\auth\exception\RequestAuthException;
use \pms\ExceptionHandle as basHandle;

class ExceptionHandle extends basHandle
{

    public function handle(\Throwable $exception,\Closure $statusCode): array
    {
        if($exception instanceof LoginAuthException){
            $data = [
                'code' => 402,
                'message' => '未登录',
            ];
        }else if($exception instanceof RequestAuthException){
            $data = [
                'code' => 403,
                'message' => $exception->getMessage(),
            ];
        }else{
            $data = parent::handle($exception,$statusCode);
        }
        return $data;
    }

}