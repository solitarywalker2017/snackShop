<?php
namespace app\api\validate;

class Address extends BaseValidate
{
    protected $rule = [
        ['name', 'require|isNotEmpty', '该项为必填项！|该项不得为空！'],
        ['mobile', 'require|isMobile', '该项为必填项！|请填写正确的格式！'],
        ['province', 'require|isNotEmpty', '该项为必填项！|该项不得为空！'],
        ['city', 'require|isNotEmpty', '该项为必填项！|该项不得为空！'],
        ['country', 'require|isNotEmpty', '该项为必填项！|该项不得为空！'],
        ['detail', 'require|isNotEmpty', '该项为必填项！|该项不得为空！'],
    ];

    //不推荐使用正则，因为复用性太差
    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}