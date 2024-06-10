<?php
return [
    'default'=>'connection1',
    // 自动写入时间戳字段
    // true为自动识别类型 false关闭
    // 字符串则明确指定时间字段类型 支持 int timestamp datetime date
    'auto_timestamp' => false,
    // 时间字段取出后的默认时间格式
    'datetime_format' => 'Y-m-d H:i:s',
    // 时间字段配置 配置格式：create_time,update_time
    'datetime_field' => '',
    'connections'=>[
        'connection1'=>[
            // 数据库类型
            'type' => 'mysql',
            // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
            'deploy' => 0,
            // 数据库读写是否分离 主从式有效
            'rw_separate' => false,
            // 主机地址
            'hostname' => '127.0.0.1',
            // 数据库端口
            'port' => '3306',
            // 数据库名
            'database' => 'pmsphp-production',
            // 用户名
            'username' => 'pmsphp',
            // 密码
            'password' => '123456',
            // 数据库编码默认采用utf8
            'charset' => 'utf8',
            // 数据库表前缀
            'prefix' => '',
            // 数据库调试模式
            'debug' => true,
            // SwooleHttp模式
            // 连接池最大连接数量,取决于mysql的max_connections,不能大于这一配置
            'pool_count' => 64,
            // 连接池最大空闲时间,取决于mysql的wait_timeout,不能大于这一配置
            'pool_wait_idle_time' => 28800,
        ]
    ]
];