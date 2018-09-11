<?php

namespace app\api\model;


class Category extends Base
{
    protected $hidden = ['delete_time', 'description', 'update_time'];

    public static function getAllCategories()
    {
        return self::all([], 'topicImg');
    }

    public function topicImg()
    {
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }
}
