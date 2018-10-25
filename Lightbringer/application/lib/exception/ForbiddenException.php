<?php
namespace app\lib\exception;

class ForbiddenException extends BaseException
{
    public $code = 403;
    public $errorCode = 10001;
    public $msg = '当前用户权限不够';
}
