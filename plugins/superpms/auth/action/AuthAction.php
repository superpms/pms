<?php

namespace plugins\superpms\auth\action;

use pms\app\Plugins;

class AuthAction{
    use Plugins;

    /**
     * 数据签名
     * @param string $data 待签名数据
     * @param string $salting 加盐值
     * @param string $privateKey 签名私钥
     * @return string 签名结果
     */
    public static function signature(string $data,string $salting,string $privateKey): string{
        return md5(md5("$data\r\n@$salting@\r\n$privateKey"));
    }

    /**
     * 登录认证签名
     * @param int $expireTime token过期时间（10位时间戳）
     * @param int $userid 登录用户标识信息
     * @return string 签名结果
     */
    public static function loginAuthSignature(int $expireTime, int $userid): string{
        $privetKey = self::config('auth-privet-key');
        $salting = self::config('auth-salting');
        return self::signature("$expireTime\r\n|$userid",$salting,$privetKey);
    }

    public static function buildLoginAuthData(int $expireTime,int $userid,array $other = []): array
    {
        return [
            ...$other,
            'token' => self::loginAuthSignature($expireTime,$userid),
            'id' => self::idShifting($userid),
            'expire_time' => $expireTime,
        ];
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

    /**
     * 数值位移混淆
     * @param int|float $id 真实数值
     * @return string 混淆数值
     */
    public static function idShifting(int|float $id): string{
        $factor = self::config('auth-factor', 2);
        return base64_encode(strtoupper(dechex($id * $factor)));
    }

    /**
     * ID 位移解密
     * @param string $b64 混淆数值
     * @return float|int|false 解密数值,失败将返回false
     */
    public static function idUnShifting(string $b64): float|int|false{
        try{
            $shifting = hexdec(base64_decode($b64));
            $factor = self::config('auth-factor', 2);
            return $shifting / $factor;
        }catch (\Throwable $e){
            return false;
        }
    }

}