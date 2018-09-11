<?php
namespace app\api\validate;

class PositiveSet extends BaseValidate
{
    protected $rule = [
        ['ids', 'require|isPositiveIntegerSet', 'ID号为必填项！|ID号须为正整数！']
    ];

    protected function isPositiveIntegerSet($value)
    {
        $valueSet = explode(',', $value);
        if (empty($valueSet)) {
            return false;
        }
        foreach ($valueSet as $id) {
            if (!$this->isPositiveInteger($id)) {
                return false;
            } else {
                return true;
            }
        }
    }
}