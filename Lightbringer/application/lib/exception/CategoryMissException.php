<?php

namespace app\lib\exception;


class CategoryMissException extends BaseException
{
    public $code = 404;
    public $msg = 'The category does not exist!';
    public $errorCode = 50000;
}