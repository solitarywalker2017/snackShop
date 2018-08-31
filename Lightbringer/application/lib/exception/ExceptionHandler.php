<?php

namespace app\lib\exception;

use think\Exception;
use think\exception\Handle;
use think\Log;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    // TP5底层抛出异常处理函数
    public function render(Exception $e)
    {
        if ($e instanceof BaseException) {
            //自定义异常
            $this->code = $e->code;
            $this->errorCode = $e->errorCode;
            $this->msg = $e->msg;
        } else {
            //系统异常
            if (config('app_debug')) {
                return parent::render($e);
            } else {
                $this->errorCode = 500;
                $this->msg = "Internal error";
                $this->code = 999;
                $this->recordInternalError($e);
            }
        }
        $result = [
            'errorCode' => $this->errorCode,
            'errorMsg' => $this->msg,
            'errorURL' => request()->url()
        ];
        return json($result, $this->code);
    }

    private function recordInternalError(Exception $e)
    {
        Log::init([
            'type' => 'file',
            'path' => LOG_PATH,
            'level' => ['error'],
        ]);
        Log::record($e->getMessage(), 'error');
    }


}