<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/18
 * Time: 16:13
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $errorCode = 10001;
    public $msg = 'token已过期或者无效';
}