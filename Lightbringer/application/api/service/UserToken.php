<?php
namespace app\api\service;


use app\api\model\User as UserModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WxException;
use think\Exception;

class UserToken extends Token
{
    private $appid = '';
    private $secret = '';
    private $code = ''; //用户凭证

    public function __construct($code)
    {
        $this->code = $code;
        $this->appid = config('wx.app_id');
        $this->secret = config('wx.app_secret');
    }

    /**
     * 获取用户OpenId和Session_key
     * @return string
     * @throws Exception
     */
    public function get()
    {
        $params = [
            'appid' => $this->appid,
            'secret' => $this->secret,
            'js_code' => $this->code,
            'grant_type' => 'authorization_code'
        ];
        $url = 'https://api.weixin.qq.com/sns/jscode2session?' . http_build_query($params);
        $res = json_decode(getCurl($url), true);
        if (empty($res)) {
            throw  new Exception('获取session_key及openID时异常，微信内部错误');
        } else {
            $loginFail = array_key_exists('errcode', $res);
            if ($loginFail) {
                throw new WxException([
                    'errorCode' => $res['errcode'],
                    'msg' => $res['errmsg']
                ]);
            } else {
                return $this->grantToken($res);
            }
        }
    }

    private function grantToken($res)
    {
        // 拿到OpenID
        $openid = $res['openid'];

        // 查询OpenID是否存在，不存在则新增
        $result = UserModel::getUserByOpenID($openid);
        if (!$result) {
            $uid = UserModel::createUserByOpenID($openid);
        } else {
            $uid = $result['id'];
        }
        // 返回令牌
        return self::grantCache($res, $uid);
    }

    /**
     * 生成缓存数据
     * @param array $result 微信返回结果(包含openid)
     * @param integer $uid 用户ID号
     * @return string
     * @throws TokenException
     */
    private function grantCache($result, $uid)
    {
        $value = json_encode([
            'result' => $result,
            'uid' => $uid,
            'scope' => ScopeEnum::$userScope
        ]);
        $key = self::generateToken();
        $expire = config('website.token_expire');
        $result = cache($key, $value, $expire);
        if (!$result) {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $key;
    }
}
