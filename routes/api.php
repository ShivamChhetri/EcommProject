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

Route::get('/allproducts','ProductApiController@index');
Route::get('/product/{product_id}','ProductApiController@show');
Route::get('allproducts/priceSort/{bool}','ProductApiController@priceSort');
Route::get('allproducts/timeSort/{bool}','ProductApiController@timeSort');
Route::get('allproducts/discountSort/{percent}','ProductApiController@discountSort');
