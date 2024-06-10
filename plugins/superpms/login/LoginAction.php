<?php

namespace plugins\superpms\login;

use pms\app\Plugins;

class LoginAction
{
    use Plugins;

    /**
     * 数据签名
     * @param string $data 待签名数据
     * @param string $salting 加盐值
     * @param string $privateKey 签名私钥
     * @return string 签名结果
     */
    public static function signature(string $data, string $salting, string $privateKey): string
    {
        return md5(md5("$data\n@$salting@\n$privateKey"));
    }

    /**
     * 登录认证签名
     * @param int $expireTime token过期时间（10位时间戳）
     * @param int $userid 登录用户标识信息
     * @param string $app 鉴权APP
     * @return string 签名结果
     */
    public static function loginAuthSignature(int $expireTime, int $userid, string $app, string|int $authority = null): string
    {
        $privetKey = self::config('auth-privet-key');
        $salting = self::config('auth-salting');
        return self::signature("$expireTime\n|$userid|\n$app\n$authority\n", $salting, $privetKey);
    }

    /**
     * @param int $expireTime
     * @param int $userid
     * @param string $app
     * @param string|int|null $authority
     * @param array $other
     * @return array
     */
    public static function buildLoginAuthData(int $expireTime, int $userid, string $app, string|int $authority = null, array $other = []): array
    {
        $data = [
            ...$other,
            'app' => $app,
            'id' => self::idShifting($userid),
            'expire_time' => $expireTime,
        ];
        if(!empty($authority) && is_int($authority)){
            $authority = self::idShifting($authority);
            $data['authority'] = $authority;
        }
        $data ['token'] = self::loginAuthSignature($expireTime, $userid, $app, $authority);
        if (!empty($authority)) {
            $data['authority'] = $authority;
        }
        return $data;
    }

    /**
     * 数值位移混淆
     * @param int|float $id 真实数值
     * @return string 混淆数值
     */
    public static function idShifting(int|float $id): string
    {
        $factor = self::config('auth-factor', 2);
        return base64_encode(strtoupper(dechex($id * $factor)));
    }

    /**
     * ID 位移解密
     * @param string $b64 混淆数值
     * @return float|int|false 解密数值,失败将返回false
     */
    public static function idUnShifting(string $b64): float|int|false
    {
        try {
            $shifting = hexdec(base64_decode($b64));
            $factor = self::config('auth-factor', 2);
            return $shifting / $factor;
        } catch (\Throwable $e) {
            return false;
        }
    }
}