<?php
namespace app\api\validate;

class PositiveInteger extends BaseValidate
{
    protected $rule = [
        ['id', 'require|isPositiveInteger', 'ID号为必填项！|ID号须为正整数！']
    ];

    protected function isPositiveInteger($value)
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }
}