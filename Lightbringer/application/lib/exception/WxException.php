<?php

namespace app\lib\exception;


class WxException extends BaseException
{
    public $code = 400;
    public $msg = 'Wechat error';
    public $errorCode = 999;
}