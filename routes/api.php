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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('admin/login','loginController@adminLogin');
Route::get('nearShop','Api\ApiController@nearShops');
Route::get('products','Api\ApiController@products');
Route::get('productImages','Api\ApiController@productImages');
Route::get('categories','Api\ApiController@categories');
Route::get('category/{id}','Api\ApiController@category');
Route::get('shops','Api\ApiController@shops');
Route::get('shop/{id}','Api\ApiController@shop');
