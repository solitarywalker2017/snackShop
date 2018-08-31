<?php

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = 'The banner does not exist!';
    public $errorCode = 40000;
}