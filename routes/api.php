<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('meta_seos', 'metaSeoAPIController');

Route::resource('menus', 'menuAPIController');

Route::resource('posts', 'postAPIController');

Route::resource('banner_homes', 'bannerHomeAPIController');

Route::resource('banners', 'bannerAPIController');

Route::resource('categories', 'categoryAPIController');

Route::resource('group_products', 'group_productAPIController');

Route::resource('makers', 'makerAPIController');

Route::resource('products', 'API\productAPIController');

Route::resource('images', 'imageAPIController');

Route::resource('filters', 'filterAPIController');

Route::resource('properties', 'propertyAPIController');

Route::resource('gifts', 'giftAPIController');

Route::put('api-update-product/{slug}', 'backend\apiController@updateProduct');