<?php
namespace app\api\controller\v1;

use app\api\model\Banner as BannerModel;
use app\api\validate\PositiveInteger;
use app\lib\exception\BannerMissException;

class Banner
{
    /*
     *  @param $id 多Banner号
     */
    public function getBanner($id)
    {
        (new PositiveInteger())->goCheck(); //拦截器
        $banner = BannerModel::getBannerByID($id);
        if (!$banner) {
            throw new BannerMissException();
        }
        return $banner;
    }
}