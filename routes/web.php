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

/*Route::get('/', function () {
    return view('welcome');
});*/
include 'route_admin.php';

/*route giao diện ngoài frontend*/
Route::group(['namespace' => 'Frontend'], function (){
    Route::get('/', 'HomeController@index')->name('get.home');
    Route::get('san-pham', 'ProductController@index')->name('get.product.list');
    Route::get('san-pham/{slug}', 'ProductDetailController@getProductDetail')->name('get.product.detail');
    Route::get('danh-muc/{slug}','CategoryController@index')->name('get.category.list');
});
