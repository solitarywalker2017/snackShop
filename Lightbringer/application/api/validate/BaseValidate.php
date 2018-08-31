<?php
namespace app\api\validate;

use think\Exception;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $params = request()->param(); //获取所有参数
        if (!$this->batch()->check($params)) {
            throw new Exception($this->error);
        } else {
            return true;
        }
    }
}