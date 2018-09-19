<?php
namespace app\api\service;


class Token
{
    const LENGTH_STR = 32;

    public static function generateToken()
    {
        //组成一个随机字符串
        $tokenName = getRandChar(self::LENGTH_STR);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $salt = config('secure.tokenSalt');
        return md5($tokenName . $timestamp . $salt);
    }
}