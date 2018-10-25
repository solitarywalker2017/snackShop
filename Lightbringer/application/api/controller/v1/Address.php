<?php

namespace app\api\controller\v1;

use app\api\controller\Base;
use app\api\model\User as UserModel;
use app\api\service\Token;
use app\api\validate\Address as AddressValidate;
use app\lib\exception\UserMissException;

class Address extends Base
{
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createAddress']
    ];

    public function createAddress()
    {
        $validate = new AddressValidate();
        $validate->goCheck();
        // 通过携带的token到缓存中获取uID（一个用户一个地址）
        $uid = Token::getCurrentUID();
        $user = UserModel::get($uid);
        if (!$user) {
            throw new UserMissException();
        }
        $data = $validate->getDataByRule(input('post.', '', 'trim'));
        if (!$user['address']) {
            // 模型关联更新
            $user->address()->save($data);
        } else {
            $user->address->update($data, ['user_id' => $uid]);
        }
        return json('操作成功！', 201);
    }
}
