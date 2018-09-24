<?php

namespace app\lib\exception;


class UserMissException extends BaseException
{
    public $code = 404;
    public $msg = 'The user does not exist!';
    public $errorCode = 60000;
}