<?php
namespace app\api\service;

use app\api\model\Product as ProductModel;
use app\lib\exception\OrderException;

class Order
{
    protected $productsFromApp;
    protected $productsFromDBase;
    protected $currentUid;

    public function __construct($products, $uid)
    {
        $this->currentUid = $uid;
        $this->productsFromApp = $products;
        $this->productsFromDBase = $this->getRealProductsInfo($this->productsFromApp);
    }

    // main function
    public function place()
    {
        return $this->getOrderStatus();
    }

    private function getOrderStatus()
    {
        $orderStatus = [
            'isPassing' => true, // 是否通过库存量检测
            'orderPrice' => 0,
            'historyOrder' => [] //保留商品详情信息
        ];
        foreach ($this->productsFromApp as $product) {
            $productStatus = $this->getRealProductInfo($product);
            if (!$productStatus['havingStock']) {
                $orderStatus['isPassing'] = false;
            }
            $orderStatus['orderPrice'] += $productStatus['totalPrice'];
            array_push($orderStatus['historyOrder'], $productStatus);
        }
        return $orderStatus;
    }

    private function getRealProductInfo($product)
    {
        $productIndex = -1;
        $pid = $product['product_id'];
        for ($i = 0; $i < count($this->productsFromDBase); $i++) {
            if ($pid == $this->productsFromDBase[$i]['id']) {
                $productIndex = $i;
            }
        }
        if ($productIndex == -1) {
            throw new OrderException();
        } else {
            $productInfo = $this->productsFromDBase[$productIndex];
            $productDetail = $this->getProductDetail($productInfo, $product['count']);
            return $productDetail;
        }
    }

    private function getProductDetail($productInfo, $count)
    {
        $productDetail['id'] = $productInfo['id'];
        $productDetail['name'] = $productInfo['name'];
        $realStock = $productInfo->stock;
        $productDetail['count'] = $count;
        $havingStock = ($realStock >= $count) ? true : false;
        $productDetail['havingStock'] = $havingStock;
        if ($havingStock) {
            $totalPrice = $productInfo->price * $count;
            //todo: update stock
        } else {
            $totalPrice = 0;
            //todo: 提示缺货
        }
        $productDetail['totalPrice'] = $totalPrice;
        return $productDetail;
    }

    private function getRealProductsInfo($products)
    {
        $productsID = [];
        foreach ($products as $item) {
            // 避免使用循环进行数据库查询操作！！！
            array_push($productsID, $item['product_id']);
        }
        $res = ProductModel::getProductsByOrder($productsID);
        return $res;
    }
}
