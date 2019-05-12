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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    // 'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    
    Route::post('signup', 'AuthController@signup');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

// Verify user And reset password Token
Route::get('verify/{token}', 'TokenController@verify');
Route::post ('sendEmailLink','TokenController@sendMail');
Route::get('reset/{token}','TokenController@reset');
Route::post('changePassword','TokenController@changePassword');


// product api end points
Route::get('/allproducts','ProductApiController@index');
Route::get('/product/{product_id}','ProductApiController@show');
Route::get('/product/type/{type}','ProductApiController@type');
Route::get('allproducts/priceSort/{bool}','ProductApiController@priceSort');
Route::get('allproducts/timeSort/{bool}','ProductApiController@timeSort');
Route::get('allproducts/discountSort/{percent}','ProductApiController@discountSort');
// end of product api end points


// user other details
    // address
Route::post("user/address","UserAddressController@addAddress");
Route::get("user/address","UserAddressController@getAddress");
Route::post("user/address/update","UserAddressController@updateAddress");
    // cart
Route::post("user/cart","UserCartController@addCart");
Route::get("user/cart","UserCartController@getCart");
Route::post("user/cart/update","UserCartController@updateCart");
Route::post("user/cart/delete","UserCartController@deleteCart");
    // order
Route::post("user/order","UserOrderController@addOrder");
Route::get("user/order","UserOrderController@getOrder");
// Route::post("user/order/update","UserOrderController@updateOrder");
// Route::post("user/order/cancel","UserOrderController@cancelOrder");