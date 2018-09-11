<?php
namespace app\api\validate;

class Count extends BaseValidate
{
    protected $rule = [
        ['count', 'isPositiveInteger|between:1,14', 'ID号为必填项！|ID号需在范围内！']
    ];
}