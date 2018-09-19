<?php
namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = [
        ['code', 'require|isNotEmpty', '请传入CODE值！|CODE值不能为空！']
    ];
}