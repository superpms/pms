<?php

namespace app\api;

use plugins\superpms\auth\exception\LoginAuthException;
use plugins\superpms\auth\exception\RequestAuthException;
use pms\exception\ClassNotFoundException;
use pms\exception\FuncNotFoundException;
use pms\exception\RequestParamsException;
use pms\exception\WarningException;
use \pms\ExceptionHandle as basHandle;

class ExceptionHandle extends basHandle{

    public function handle(\Throwable $exception): array{
        $data = [
            'message' => $exception->getMessage(),
        ];
        if($this->debug &&
            (
                $exception instanceof WarningException
                || $exception instanceof ClassNotFoundException
                || $exception instanceof FuncNotFoundException
            )
        ){
            $data['code'] = $this->handleCode[get_class($exception)];
            $data['file'] = $exception->getFile();
            $data['line'] = $exception->getLine();
            $data['trace'] = $exception->getTraceAsString();
        }else if($exception instanceof RequestParamsException){
            $data= [
                ...$data,
                'code'=>$this->handleCode[get_class($exception)],
                'field' => $exception->getField(),
                'desc' => $exception->getDesc(),
                'type' => $exception->getType()
            ];
        }else if($exception instanceof LoginAuthException){
            $data= [
                ...$data,
                'code'=>400,
            ];
        }else if($exception instanceof RequestAuthException){
            $data= [
                ...$data,
                'code'=>401,
            ];
        }
        return $data;
    }

}