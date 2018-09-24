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

    protected function isNotEmpty($value)
    {
        return empty($value) ? false : true;
    }

    //参数过滤
    public function getDataByRule($data)
    {
        if (array_key_exists('user_id', $data) || array_key_exists('uid', $data)) {
            throw new ParameterException([
                'msg' => '参数中含有非法字段'
            ]);
        } // 过滤body中的UID值
        //构建新校验规则
        $legalData = [];
        foreach ($this->rule as $k => $v) {
            $legalData[$v[0]] = $data[$v[0]];
        }
        return $legalData;
    }
}