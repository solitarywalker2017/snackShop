<?php
use think\Route;

// 默认从头匹配
Route::get('banner/:id', 'api/v1.Banner/getBanner');

Route::get('category', 'api/v1.Category/getCategories');

// 使用POST方式部分提高安全性
Route::post('token/user', 'api/v1.Token/getToken');

Route::post('address', 'api/v1.Address/createAddress');

Route::post('order', 'api/v1.Order/placeOrders');

Route::group('theme', function () {
    Route::get('/', 'api/v1.Theme/getThemes');
    Route::get(':id', 'api/v1.Theme/getProducts', [], [':id' => '\d+']);
});

Route::group('product', function () {
    Route::get('lastest', 'api/v1.Product/getLastests');
    Route::get('cate/:id', 'api/v1.Product/getProductsByCate', [], [':id' => '\d+']);
    Route::get(':id', 'api/v1.Product/getDetail', [], [':id' => '\d+']);
});
