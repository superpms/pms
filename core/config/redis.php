<?php
return [
    'default' => 'connection1',
    'connections'=>[
        'connection1' => [
            // 数据库类型
            'type' => 'redis',
            // 服务器地址
            'host' => '127.0.0.1',
            // 服务器端口
            'port' => 6379,
            // 连接超时时间
            'connect_timeout' => 10,
            // 重连间隔时间（以毫秒为单位）。
            'retry_interval'=>0,
            // 读取超时时间
            'read_timeout' => 0,
            // 命令执行失败时重试的次数。
            'retry_times' => 0,
            // 链接密码
            'password' => "",
            // 选择的表
            'database' => 2,
            // 前缀
            'prefix' => 'pms-xx:',
            // SwooleHttp模式
            // 连接池最大连接数量,取决于redis的maxclients,不能大于这一配置
            'pool_count' => 64,
            // 连接池空闲超时时间，取决于Redis的timeout配置
            'pool_wait_time' => 300,
        ],
    ]
];