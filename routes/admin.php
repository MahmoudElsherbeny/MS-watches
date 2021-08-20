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
    Route::get('/create','backend\ProductCtrl@create')->name('create');
    Route::get('/{id}/edit','backend\ProductCtrl@edit')->name('edit');
    Route::post('/{id}/edit','backend\ProductCtrl@update');
    Route::post('/{id}/delete','backend\ProductCtrl@destroy')->name('delete');
    Route::get('/{id}','backend\ProductCtrl@product')->name('info');
    Route::post('/{id}/sale','backend\ProductCtrl@sale')->name('sale');
    Route::post('/{id}/image/{image}/edit','backend\ProductCtrl@image_update')->name('image_edit');
    Route::post('/{id}/image/{image}/delete','backend\ProductCtrl@image_destroy')->name('image_delete');
    
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
    //Route::post('/{id}/edit','backend\EditorController@update');    
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
