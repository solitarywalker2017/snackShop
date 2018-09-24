<?php

namespace app\api\model;

class User extends Base
{
    protected $hidden = ['delete_time', 'create_time', 'update_time'];

    public function address()
    {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public static function getUserByOpenID($openid)
    {
        return self::where('openid', $openid)->find();
    }

    public static function createUserByOpenID($openid)
    {
        $user = self::create([
            'openid' => $openid
        ]);
        return $user['id'];
    }
}
