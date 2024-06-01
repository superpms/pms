<?php
// web类型应用
return [
    // 表示http模式访问的app
    'app_name'=>'api',
    'default_controller'=>'Index',
    'swoole'=>[
        'host'=>'127.0.0.1',
        'port'=>9501,
        'config'=>[
            'worker_num'=>28,
            'max_wait_time'=>10,
        ]
    ],
    'request_header'=>[
        // 额外通讯协议标头，可以是数组，可以是字符串
        'scheme_name'=>[
            'x-forwarded-scheme'
        ],
        // 额外IP标头，可以是数组，可以是字符串
        'ip_name'=>[
            'x-real-ip'
        ],
        'userinfo'=>'x-userinfo',
        'token'=>'x-token',
        'time'=>'x-time',
        'last_time'=>'x-last-time',
        'terminal'=>'x-terminal',
        'request_time'=>'x-request-time',
        'request_token'=>'x-request-token',
    ],
    'response_header'=>[
        // 预检请求缓存秒数
        'Access-Control-Max-Age'=>86400,
        'Access-Control-Allow-Origin'=>'*',
        // 'access-control-allow-origin'=>'http://localhost:8080'
        'Access-Control-Allow-Methods'=>'GET,POST,PUT,DELETE,OPTIONS',
        'Access-Control-Allow-Headers'=>'x-id,x-token,x-time,x-last-time,x-terminal,r-request-time,r-request-token',
//        'Access-Control-Allow-Credentials'=>'true',
//        'Access-Control-Expose-Headers'=>'Content-Length,Content-Type,Authorization',
    ]
];