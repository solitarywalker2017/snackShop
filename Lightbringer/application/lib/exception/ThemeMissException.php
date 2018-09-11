<?php

namespace app\lib\exception;


class ThemeMissException extends BaseException
{
    public $code = 404;
    public $msg = 'The theme does not exist!';
    public $errorCode = 30000;
}