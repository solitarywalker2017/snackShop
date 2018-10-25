<?php
namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Validate;

class OrderPlace extends BaseValidate
{

    protected $productsFromApp = [
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

    protected $productsFromDBase = [
        [
            'product_id' => 1,
            'count' => 13
        ],
        [
            'product_id' => 2,
            'count' => 3
        ],
        [
            'product_id' => 3,
            'count' => 1
        ]
    ];

    protected $rule = [
        ['products', 'checkProducts', '不符合要求']
    ];

    // 验证一： product是否为数组
    protected function checkProducts($value)
    {
        if (empty($value)) {
            throw new ParameterException([
                'msg' => '商品列表不得为空！'
            ]);
        }
        if (!is_array($value)) {
            throw new ParameterException([
                'msg' => '商品列表参数不正确！'
            ]);
        }
        foreach ($value as $v) {
            $this->checkProduct($v);
        }
        return true;
    }

    // 验证二： product中各子数组是否符合要求
    protected function checkProduct($product)
    {
        $singleRule = [
            ['product_id', 'require|isPositiveInteger'],
            ['count', 'require|isPositiveInteger']
        ];
        $validate = new Validate($singleRule);
        if (!$validate->check($product)) {
            return $validate->getError();
//            throw new ParameterException([
//                'msg' => '商品参数错误！'
//            ]);
        }
    }
}
