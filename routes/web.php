<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/','ProductsController@index');

Route::resource('products','AdminProductsController');
// Route::resource('productPics','ProductPicsController');
Route::get('productPics/add/{product_id}','AdminProductPicsController@addPic');
Route::post('productPics/store','AdminProductPicsController@storePic');
Route::get('productPics/{id}/edit','AdminProductPicsController@edit');
Route::put('productPics/{id}','AdminProductPicsController@update');
Route::delete('productPics/{id}','AdminProductPicsController@destroy');
// ROute::get('productPics','ProductPicsController@index');
