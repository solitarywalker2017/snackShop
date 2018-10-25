<?php
namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;

class Token
{
    const LENGTH_STR = 32;

    /**
     * 生成Token的key
     * @return string
     */
    public static function generateToken()
    {
        //组成一个随机字符串
        $tokenName = getRandChar(self::LENGTH_STR);
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $salt = config('secure.tokenSalt');
        return md5($tokenName . $timestamp . $salt);
    }

    public static function getCurrentScope()
    {
        $currentScope = self::getCurrentToken('scope');
        return $currentScope;
    }

    public static function getCurrentUID()
    {
        $currentUID = self::getCurrentToken('uid');
        return $currentUID;
    }

    // 验证用户权限
    public static function needScope($userLevel)
    {
        $currentScope = self::getCurrentScope();
        if ($currentScope) {
            $condition = '';
            switch ($userLevel) {
                case 'user':
                    $condition = $currentScope . "==" . ScopeEnum::$userScope;
                    break;
                case 'admin':
                    $condition = $currentScope . "==" . ScopeEnum::$adminScope;
                    break;
                case 'both':
                    $condition = $currentScope . ">=" . ScopeEnum::$userScope;
                    break;
            }
            if ($condition) {
                return true;
            } else {
                throw  new ForbiddenException();
            }
        } else {
            throw new TokenException();
        }
    }

    /**
     * 根据传递的参数返回Token中的值
     * @param string $key ("uid"/"scope"/"result"(含openID))
     * @return  mixed
     * @throws Exception
     * @throws TokenException
     */
    private static function getCurrentToken($key)
    {
        //从头信息中获取token,body中获取不安全
        $token = request()->header("token");
        $tokenList = Cache::get($token);
        if (!$tokenList) {
            throw  new TokenException();
        }
        if (!is_array($tokenList)) {
            $tokenList = json_decode($tokenList, true);
        }
        if (!array_key_exists($key, $tokenList)) {
            throw new Exception('指定的token不存在！');
        }
        return $tokenList[$key];
    }
}
