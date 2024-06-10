<?php

namespace plugins\superpms\request;

use pms\app\Plugins;

class RequestAction
{
    use Plugins;
    /**
     * 数据签名
     * @param string $data 待签名数据
     * @param string $salting 加盐值
     * @param string $privateKey 签名私钥
     * @return string 签名结果
     */
    public static function signature(string $data,string $salting,string $privateKey): string{
        return md5(md5("$data\n@$salting@\n$privateKey"));
    }

    /**
     * 请求认证签名
     * @param int $requestTime 请求时间
     * @return string 签名结果
     */
    public static function requestAuthSignature(int $requestTime): string{
        $salting = self::config('request-salting','');
        $privateKey = self::config('request-privet-key','');
        return self::signature("$requestTime|$salting",$salting,$privateKey);
    }
}