<?php
/**
 * 用户登录认证中间件配置
 */
return [
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
    // 登录认证终端所在标头名称
    'header-app'=>'x-app',

    // ------------ 访问权限认证 ------------
    // 权限认证键所在标头名称
    'header-authority'=>'x-authority',
    // 权限数据转换方法（最终返回当前权限所有权限）
    'authority-transform'=>function($authority){
        return $authority;
    },
];