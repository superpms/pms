<?php

namespace app\api;

use plugins\superpms\login\AuthorityAuthException;
use plugins\superpms\login\LoginAuthException;
use plugins\superpms\request\RequestAuthException;
use pms\ExceptionHandle as basHandle;

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
        }else if($exception instanceof AuthorityAuthException){
            $data = [
                'code' => 404,
                'message' => $exception->getMessage(),
            ];
        }else{
            $data = parent::handle($exception,$statusCode);
        }
        return $data;
    }

}