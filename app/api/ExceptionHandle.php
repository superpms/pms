<?php

namespace app\api;

class ExceptionHandle extends \pms\ExceptionHandle{

    public function handle(\Throwable $exception): array{
        $this->handleCode = [
            ...$this->handleCode,
        ];
        return parent::handle($exception);
    }

}