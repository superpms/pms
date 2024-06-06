<?php
// 当前应用全局中间件
return [
    // PMS:请求认证中间件
    \plugins\superpms\auth\middleware\RequestAuthMiddleware::class,
    // PMS:登录认证中间件
    \plugins\superpms\auth\middleware\LoginAuthMiddleware::class,
];