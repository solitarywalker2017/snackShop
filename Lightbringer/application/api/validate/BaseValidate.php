<?php
namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Exception;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        $params = request()->param(); //获取所有参数
        if (!$this->batch()->check($params)) {
            throw new ParameterException([]);
        } else {
            return true;
        }
    }

    protected function isPositiveInteger($value)
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }
}