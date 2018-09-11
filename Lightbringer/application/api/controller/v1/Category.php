<?php

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryMissException;
use think\Controller;

class Category extends Controller
{
    public function getCategories()
    {
        $result = CategoryModel::getAllCategories();
        if (!$result) {
            throw new CategoryMissException();
        }
        return $result;
    }
}
