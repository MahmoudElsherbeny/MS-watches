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
Route::get('/category/{id}', 'frontend\HomeController@category')->name('category_page');
Route::get('/shop', 'frontend\HomeController@shopPage')->name('shop');
Route::get('/about', 'frontend\HomeController@aboutus')->name('aboutus');
Route::get('/login', 'frontend\HomeController@login')->name('login');
Route::get('/register_success', 'frontend\HomeController@register_success')->name('register_success');

//contact routes
Route::group(['prefix'=>'contact', 'as'=>'contact.'] , function() {

    Route::get('/', 'frontend\ContactController@index')->name('index');
    Route::POST('/', 'frontend\ContactController@send')->name('send');

});

//product routes
Route::get('product/{id}/details', 'frontend\productCtrl@product_detailes')->name('product_detailes');
Route::get('product/{id}/delete/{review}', 'frontend\productCtrl@review_destroy');
Route::post('product/{id}/delete/{review}', 'frontend\productCtrl@review_destroy')->name('review_delete');

//cart routes
Route::group(['prefix'=>'cart', 'as'=>'cart.'] , function() {

    Route::get('/', 'frontend\CartController@index')->name('index');
    Route::get('add/{id}', 'frontend\CartController@addToCart')->name('add');
    Route::get('update/{id}/{quantity}', 'frontend\CartController@updateCart')->name('update');
    Route::get('checkout','frontend\CartController@checkout_page')->middleware(['auth','verified'])->name('checkout_page');

});

//wishlist routes
Route::group(['prefix'=>'wishlist', 'as'=>'wishlist.'] , function() {

    Route::get('/', 'frontend\WishlistController@index')->name('index');
    Route::get('add/{id}', 'frontend\WishlistController@addToWishlist')->name('add');

});



Auth::routes(['verify' => true]);
