<?php

namespace app\api;

class ExceptionHandle extends \pms\ExceptionHandle{
    protected string $contentType = JSON_CONTENT_TYPE;

    public function handle(\Throwable $exception): array{
        $this->handleCode = [
            ...$this->handleCode,
        ];
        return parent::handle($exception);
    }

}