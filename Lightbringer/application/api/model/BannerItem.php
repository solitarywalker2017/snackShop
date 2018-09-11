<?php

namespace app\api\model;

use think\Model;

class BannerItem extends Model
{
    protected $hidden = ['delete_time', 'update_time', 'id', 'img_id', 'banner_id'];

    public function img()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}
