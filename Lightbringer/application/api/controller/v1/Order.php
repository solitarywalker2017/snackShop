<?php

namespace app\api\controller\v1;

use app\api\controller\Base;
use app\api\service\Order as OrderService;
use app\api\service\Token;
use app\api\validate\OrderPlace;

class Order extends Base
{
    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrders']
    ];

    // 管理员不能调用此接口
    public function placeOrders()
    {
        (new OrderPlace())->goCheck();
//        $products = input('post.'); // “/a”获取数组参数
        $uid = Token::getCurrentUID();
        $productsFromApp_mock = [
            [
                'product_id' => 1,
                'count' => 3
            ],
            [
                'product_id' => 2,
                'count' => 3
            ],
            [
                'product_id' => 3,
                'count' => 3
            ]
        ];

        $order = new OrderService($productsFromApp_mock, $uid);
        halt($order->place());
    }
}
