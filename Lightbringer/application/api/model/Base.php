<?php

namespace app\api\model;

use think\Model;

class Base extends Model
{

    protected function prefixImgUrl($value, $data)
    {
        // 业务逻辑的封装
        $finalUrl = $value;
        if ($data['from'] == 1) {
            $finalUrl = config('website.img_prefix') . $value;
        }
        return $finalUrl;
    }
}
