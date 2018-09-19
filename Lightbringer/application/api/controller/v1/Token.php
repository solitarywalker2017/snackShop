<?php

namespace app\api\controller\v1;

use app\api\service\UserToken;
use app\api\validate\TokenGet;
use think\Controller;

class Token extends Controller
{
    public function getToken($code = '')
    {
        (new TokenGet())->goCheck();
        $userToken = (new UserToken($code))->get();
        return ['userToken' => $userToken];
    }
}
