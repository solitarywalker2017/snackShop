<?php
use think\Route;

Route::get('banner/:id', 'api/v1.Banner/getBanner');
// 默认从头匹配
Route::get('theme', 'api/v1.Theme/getThemes');
Route::get('theme/:id', 'api/v1.Theme/getProducts');

Route::get('product/lastest', 'api/v1.Product/getLastests');
Route::get('product/cate/:id', 'api/v1.Product/getProductsByCate');

Route::get('category', 'api/v1.category/getCategories');

// 使用POST方式部分提高安全性
Route::post('token/user', 'api/v1.token/getToken');



