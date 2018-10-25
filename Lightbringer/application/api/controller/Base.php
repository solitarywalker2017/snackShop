<?php

namespace app\api\controller;

use app\api\service\Token;
use think\Controller;

class Base extends Controller
{
    protected static function checkPrimaryScope()
    {
        Token::needScope('both');
    }

    protected static function checkExclusiveScope()
    {
        Token::needScope('admin');
    }
}
