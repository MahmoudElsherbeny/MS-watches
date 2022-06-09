<?php

use Illuminate\Support\Facades\Route;

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


/************************************************************************/
/* ---------------------     backend routes     -----------------------*/
/***********************************************************************/

//main pages routes
Route::get('/', 'backend\DashController@dashboard')->name('dashboard')->middleware('admin');

//categories routes
Route::group(['middleware'=>'admin', 'prefix'=>'category', 'as'=>'category.'] , function() {

    Route::get('/','backend\CategoryCtrl@index')->name('index');
    Route::get('/create','backend\CategoryCtrl@create')->name('create');
    Route::get('/{id}/edit','backend\CategoryCtrl@edit')->name('edit');
    //Route::post('/search','backend\CategoryCtrl@update');
    Route::post('/{id}/delete','backend\CategoryCtrl@destroy')->name('delete');

});

//products routes
Route::group(['middleware'=>'admin', 'prefix'=>'products', 'as'=>'product.'] , function() {

    Route::get('/','backend\ProductCtrl@index')->name('index');
    Route::get('/reviews','backend\ProductCtrl@reviews')->name('reviews');
    Route::post('/{id}/add_as_website_review','backend\ProductCtrl@add_to_website')->name('add_to_website');
    Route::get('/create','backend\ProductCtrl@create')->name('create');
    Route::get('/{id}/edit','backend\ProductCtrl@edit')->name('edit');
    Route::post('/{id}/edit','backend\ProductCtrl@update');
    Route::post('/{id}/delete','backend\ProductCtrl@destroy')->name('delete');
    Route::get('/{id}','backend\ProductCtrl@product')->name('info');
    Route::post('/{id}/sale','backend\ProductCtrl@sale')->name('sale');
    Route::post('/{id}/image/add','backend\ProductCtrl@image_add')->name('image_add');
    Route::post('/{id}/image/{image}/edit','backend\ProductCtrl@image_update')->name('image_edit');
    Route::post('/{id}/image/{image}/delete','backend\ProductCtrl@image_destroy')->name('image_delete');

});

//orders routes
Route::group(['middleware'=>'admin', 'prefix'=>'orders', 'as'=>'order.'] , function() {

    Route::get('/','backend\OrderController@index')->name('index');
    Route::post('/{id}/cancel','backend\OrderController@destroy')->name('cancel');
    Route::get('/{id}','backend\OrderController@product')->name('info');

});

//Editors routes
Route::group(['middleware'=>['admin','admin.pages'], 'prefix'=>'editors', 'as'=>'editor.'] , function() {

    Route::get('/','backend\EditorController@index')->name('index');
    Route::get('/{id}/edit','backend\EditorController@edit')->name('edit');
    Route::post('/{id}/edit','backend\EditorController@update');
    Route::post('/{id}/delete','backend\EditorController@destroy')->name('delete');

});

//logs routes
Route::group(['middleware'=>['admin','admin.pages'], 'prefix'=>'logs', 'as'=>'DashLogs.'] , function() {

    Route::get('/','backend\LogsCtrl@index')->name('index');
    Route::post('/delete','backend\LogsCtrl@destroy')->name('delete');

});

//slider routes
Route::group(['middleware'=>'admin', 'prefix'=>'slider', 'as'=>'slider.'] , function() {

    Route::get('/','backend\SliderController@index')->name('index');
    Route::get('/create','backend\SliderController@create')->name('create');
    Route::get('/{id}/edit','backend\SliderController@edit')->name('edit');
    Route::post('/{id}/delete','backend\SliderController@destroy')->name('delete');

});

//settings routes
Route::group(['middleware'=>'admin', 'prefix'=>'setting', 'as'=>'setting.'] , function() {

    Route::get('/','backend\SettingController@index')->name('index');
    Route::get('/edit','backend\SettingController@edit')->name('edit');
    Route::get('/website_reviews','backend\SettingController@website_reviews')->name('reviews');
    Route::post('/website_reviews/{id}/edit','backend\SettingController@review_update')->name('review_update');
    Route::post('/website_reviews/{id}/delete','backend\SettingController@review_destroy')->name('review_delete');
    Route::get('/website_brands','backend\SettingController@website_brands')->name('brands');
    Route::get('/website_brands/create','backend\SettingController@brand_create')->name('brand_create');
    Route::get('/website_brands/{id}/edit','backend\SettingController@brand_edit')->name('brand_edit');
    Route::post('/website_brands/{id}/delete','backend\SettingController@brand_destroy')->name('brand_delete');
});

//states routes
Route::group(['middleware'=>'admin', 'prefix'=>'states', 'as'=>'state.'] , function() {

    Route::get('/','backend\StateController@index')->name('index');
    Route::get('/create','backend\StateController@create')->name('create');
    Route::post('/{id}/edit','backend\StateController@update')->name('update');
    Route::post('/{id}/delete','backend\StateController@destroy')->name('delete')->middleware('admin.pages');
});


//admin auth routes
Route::group(['prefix'=>'register', 'as'=>'AdminAuth.'] , function() {

    Route::get('/', 'AdminAuth\RegisterController@RegisterForm')->name('RegisterForm');
    Route::post('/', 'AdminAuth\RegisterController@register');

});

Route::group(['as'=>'AdminAuth.'] , function() {

    Route::get('login', 'AdminAuth\LoginController@LoginForm')->name('LoginForm');
    Route::post('login', 'AdminAuth\LoginController@login');
    Route::post('logout', 'AdminAuth\LoginController@logout')->name('logout');

});
