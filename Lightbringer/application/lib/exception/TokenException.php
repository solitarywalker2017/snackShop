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
    public $code = '';
    public $errorCode = '';
    public $msg = '';
}