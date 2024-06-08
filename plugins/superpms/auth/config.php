<?php
return [
    #------------------ 请求认证中间件配置 ------------------
    // 请求签名密钥
    'request-privet-key'=>'6202EA81EBD5537E5465FD0E7DEB4901',
    // 请求签名加盐字符串
    'request-salting'=>'pms-auth-request',
    // 请求签名所在标头名称
    'header-request-token'=>'x-request-token',
    'header-request-time'=>'x-request-time',
    // 单个请求有效时间(秒)
    'request-time'=>60,

    #------------------ 用户登录认证中间件配置 ------------------
    // 登录认证密钥
    'auth-privet-key'=>'c6d36ac28a6669d1184b67717eb8ab63',
    // 登录认证加盐字符串
    'auth-salting'=>'pms-auth-login',
    // id偏移值
    'auth-factor'=>28,
    // 登录认证所在标头名称
    'header-token'=>'x-token',
    // 登录认证用户标识信息所在标头名称
    'header-userid'=>'x-id',
    // 登录认证过期时间标头名称
    'header-expire-time'=>'x-expire-time',

];