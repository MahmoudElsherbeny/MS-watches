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

});

//order routes
Route::group(['middleware'=>['auth','verified'], 'prefix'=>'order', 'as'=>'UserOrder.'] , function() {

    Route::get('checkout','frontend\OrderController@checkout')->name('checkout_page');
    Route::post('checkout','frontend\OrderController@order')->name('store');
    Route::get('{id}/{name}/{user}','frontend\OrderController@order_detailes')->name('detailes');
    Route::Post('{id}/{name}/{user}','frontend\OrderController@cancel')->name('cancel');

});

//wishlist routes
Route::group(['prefix'=>'wishlist', 'as'=>'wishlist.'] , function() {

    Route::get('/', 'frontend\WishlistController@index')->name('index');
    Route::get('add/{id}', 'frontend\WishlistController@addToWishlist')->name('add');

});

//user profile routes
Route::group(['prefix'=>'profile', 'as'=>'UserProfile.'] , function() {

    Route::get('/{id}/{name}/', 'frontend\ProfileController@index')->name('profile');
    Route::get('/{id}/{name}/edit', 'frontend\ProfileController@edit')->middleware(['auth'])->name('edit');
    Route::post('/{id}/{name}/edit', 'frontend\ProfileController@update')->middleware(['auth','verified']);
    Route::get('/{id}/{name}/change_password', 'frontend\ProfileController@ShowChangePasswordForm')->middleware(['auth'])->name('change_password');
    Route::post('/{id}/{name}/change_password', 'frontend\ProfileController@ChangePassword')->middleware(['auth','verified']);
    Route::get('/{id}/{name}/orders', 'frontend\ProfileController@orders')->middleware(['auth','verified'])->name('orders');

});


Auth::routes(['verify' => true]);
