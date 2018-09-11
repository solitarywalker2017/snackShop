<?php

namespace app\api\model;

class Image extends Base
{
    protected $hidden = ['delete_time', 'update_time', 'id', 'from'];

    // 获取器  命名："get"+字段名（首字母大写）+"Attr"
    public function getUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }
}
