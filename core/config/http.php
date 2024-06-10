<?php
// web类型应用
return [
    'default_controller'=>'Index',
    'header'=>[
        // 额外通讯协议标头，可以是数组，可以是字符串
        // (如 使用Nginx进行了反向代理，则可与Nginx配置相同的 协议标头进行真实的http协议获取)
        'scheme_name'=>[
            'x-forwarded-scheme'
        ],
        // 额外IP标头，可以是数组，可以是字符串
        // (如 使用Nginx进行了反向代理，则可与Nginx配置相同的 AP标头进行真实的IP获取)
        'ip_name'=>[
            'x-real-ip'
        ],
    ],
    'cors'=>[
        // 预检请求缓存秒数
        'Access-Control-Max-Age'=>86400,
        // 允许跨域的地址
        'Access-Control-Allow-Origin'=>'*',
        // 'access-control-allow-origin'=>'http://localhost:8080'
        // 允许跨域的方法
        'Access-Control-Allow-Methods'=>'GET,POST,PUT,DELETE,OPTIONS',
        // 允许跨域携带的请求头
        'Access-Control-Allow-Headers'=>'content-type,x-request-time,x-request-token,x-token,x-id,x-expire-time,x-app,x-authority,x-authority-token',
//        'Access-Control-Allow-Credentials'=>'true',
//        'Access-Control-Expose-Headers'=>'Content-Length,Content-Type,Authorization',
    ],
    'swoole'=>[
        'host'=>'127.0.0.1',
        'port'=>9501,
        'config'=>[
            'worker_num'=>28,
            'max_wait_time'=>10,
        ]
    ],
];