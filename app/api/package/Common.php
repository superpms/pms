<?php

namespace app\api\package;

use pms\Controller;

abstract class Common extends Controller
{
    protected array|string $middleware = [];
    protected bool $token = true;
}