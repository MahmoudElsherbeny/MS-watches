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
/* --------------------     frontend routes     -----------------------*/
/***********************************************************************/

//main pages routes
Route::get('/', 'frontend\HomeController@index')->name('home');
Route::get('/shop', 'frontend\HomeController@shopPage')->name('shop');
Route::get('/about', 'frontend\HomeController@aboutus')->name('aboutus');
Route::get('/contact', 'frontend\HomeController@contact')->name('contact');
Route::get('/login', 'frontend\HomeController@login')->name('login');
Route::get('/register_success', 'frontend\HomeController@register_success')->name('register_success');

//product routes
Route::get('product/{id}/details', 'frontend\productCtrl@product_detailes')->name('product_detailes');
Route::get('product/{id}/delete/{review}', 'frontend\productCtrl@review_destroy');
Route::post('product/{id}/delete/{review}', 'frontend\productCtrl@review_destroy')->name('review_delete');

//cart routes
Route::group(['prefix'=>'cart', 'as'=>'cart.'] , function() {

    Route::get('/', 'frontend\CartController@cart')->name('index');
    Route::get('add/{id}', 'frontend\CartController@addToCart')->name('add');
    Route::post('remove/{id}','frontend\CartController@remove')->name('remove');
    Route::get('checkout','frontend\CartController@checkout_page')->middleware('auth')->name('checkout_page');

});



Auth::routes(['verify' => true]);
