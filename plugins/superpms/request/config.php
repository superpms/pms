<?php
/**
 * 请求认证中间件配置
 */
return [
    // 请求签名密钥
    'request-privet-key'=>'6202EA81EBD5537E5465FD0E7DEB4901',
    // 请求签名加盐字符串
    'request-salting'=>'pms-auth-request',
    // 请求签名所在标头名称
    'header-request-token'=>'x-request-token',
    'header-request-time'=>'x-request-time',
    // 单个请求有效时间(秒)
    'request-time'=>60,
];