<?php

namespace app\lib\exception;


class ProductMissException extends BaseException
{
    public $code = 404;
    public $msg = 'The product does not exist!';
    public $errorCode = 20000;
}