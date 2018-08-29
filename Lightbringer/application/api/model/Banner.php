<?php

namespace app\api\model;

use think\Model;

class Banner extends Model
{
    public static function getBannerByID($id)
    {
        return self::find($id);
    }
}