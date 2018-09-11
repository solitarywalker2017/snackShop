<?php

namespace app\api\controller\v1;

use app\api\model\Theme as ThemeModel;
use app\api\validate\PositiveInteger;
use app\api\validate\PositiveSet;
use app\lib\exception\ProductMissException;
use app\lib\exception\ThemeMissException;
use think\Controller;

class Theme extends Controller
{
    public function getThemes($ids = '')
    {
        (new PositiveSet())->goCheck();
        $idSet = explode(',', $ids);
        $result = ThemeModel::getThemesList($idSet);
        if (!$result) {
            throw  new ThemeMissException();
        }
        return $result;
    }

    public function getProducts($id)
    {
        (new PositiveInteger())->goCheck();
        $result = ThemeModel::getRelationProducts($id);
        if (!$result) {
            throw  new ProductMissException();
        }
        return $result;
    }
}
