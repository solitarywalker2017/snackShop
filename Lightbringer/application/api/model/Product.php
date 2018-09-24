<?php

namespace app\api\model;

class Product extends Base
{
    protected $hidden = ['delete_time', 'update_time', 'from', 'category_id', 'create_time', 'img_id', 'pivot'];

    public function getMainImgUrlAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    public function category()
    {
        return $this->belongsTo('Category', 'category_id', 'id');
    }

    public function property()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public function image()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }


    public static function getLastestProducts($count)
    {
        return self::limit($count)->order('id desc')->select();
    }

    public static function getProductsByCate($id)
    {
        return self::where('category_id', $id)->order('id desc')->select();
    }

    public static function getProductByID($id)
    {
        return self::with(['property'])
            ->with(['image' => function ($query) {
                $query->with(['imgUrl'])->order('order', 'asc');
            }])
            ->find($id);
    }
}
