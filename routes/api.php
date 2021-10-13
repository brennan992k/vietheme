<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('products', 'InixAPIController@products')->name('products');
Route::get('products/{customer_api_token}/product-verify/{purchase_code}', 'InixAPIController@product_verify');
Route::get('auth-user/{customer_api_token}', 'InixAPIController@auth_customer');

Route::get('auth-user-products/{customer_api_token}', 'InixAPIController@vendors_product');

Route::get('statement-search/','VendorController@statementsearch');

// http://localhost/infix/digital_market_place/api/products/TReUEGQkhH7KSfbDDadIb0AARpGRQQMQp97QOkv7IXSNlKUnhZJ0lyiXa4iu/product-verify/NNRL-1577-8664-0520
