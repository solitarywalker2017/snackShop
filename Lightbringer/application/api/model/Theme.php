<?php

namespace app\api\model;

class Theme extends Base
{
    protected $hidden = ['delete_time', 'update_time', 'id', 'topic_img_id', 'head_img_id'];

    public function topicImg()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }

    public function headImg()
    {
        return $this->belongsTo('Image', 'head_img_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany('Product', 'theme_product', 'product_id', 'theme_id');
    }


    public static function getThemesList($idSet = [])
    {
        return self::with(['topicImg', 'headImg'])->select($idSet);
    }

    public static function getRelationProducts($id)
    {
        return self::with(['products', 'topicImg', 'headImg'])->find($id);
    }
}
