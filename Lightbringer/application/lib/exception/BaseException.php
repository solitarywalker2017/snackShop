<?php

namespace app\lib\exception;

use think\Exception;

/**
 * Class BaseException
 * @package app\lib\exception
 */
class BaseException extends Exception
{
    public $code = 400;
    public $msg = 'Bad Request';
    public $errorCode = 10000;

    public function __construct($params = [])
    {
        if (!is_array($params)) {
            throw new Exception('参数传递失败！');
        }
        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if (array_key_exists('errorCode', $params)) {
            $this->errCode = $params['errorCode'];
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
    }
}