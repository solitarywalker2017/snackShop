<?php

namespace app\api\controller\v1;

use app\api\model\Product as ProductModel;
use app\api\validate\Count;
use app\api\validate\PositiveInteger;
use app\lib\exception\ProductMissException;
use think\Controller;

class Product extends Controller
{
    public function getLastests($count = 14)
    {
        (new Count())->goCheck();
        $result = ProductModel::getLastestProducts($count);
        if (!$result) {
            throw new ProductMissException();
        }
        return $result;
    }

    public function getProductsByCate($id)
    {
        (new PositiveInteger())->goCheck();
        $result = ProductModel::getProductsByCate($id);
        if (!$result) {
            throw  new ProductMissException();
        }
        $this->hiddenSummary($result);
        return $result;
    }

    public function getDetail($id)
    {
        (new PositiveInteger())->goCheck();
        $result = ProductModel::getProductByID($id);
        if (!$result) {
            throw new ProductMissException();
        }
        return $result;
    }


    /**
     * 临时性隐藏Summary字段
     * @param  array $res 要处理的结果数组
     * @return \think\model\Collection
     */
    private function hiddenSummary($res)
    {
        $result = collection($res);
        $result = $result->hidden(['summary']);
        return $result;
    }
}
