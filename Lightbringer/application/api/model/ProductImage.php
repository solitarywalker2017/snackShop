<?php

namespace app\api\model;

use think\Model;

class ProductImage extends Model
{
    protected $hidden = ['img_id', 'id', 'product_id', 'delete_time', 'update_time'];

    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}
