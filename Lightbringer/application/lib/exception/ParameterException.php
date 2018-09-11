<?php

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public $msg = 'The parameter is Error!';
    public $errorCode = 10000;
}