<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application dashboard. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/


/************************************************************************/
/* ---------------------     backend routes     -----------------------*/
/***********************************************************************/

//main pages routes
Route::get('/', 'backend\DashController@dashboard')->name('dashboard')->middleware(['admin','admin.verified']);

//notifications routes
Route::group(['middleware'=>['admin','admin.verified'], 'prefix'=>'notification', 'as'=>'AdminNotification.'] , function() {
    Route::get('/mark_all_read', 'backend\NotificationController@mark_all_read')->name('all_read');
    Route::get('/mark_read/{id}', 'backend\NotificationController@mark_read')->name('read');
});

//categories routes
Route::group(['middleware'=>['admin','admin.verified'], 'prefix'=>'category', 'as'=>'category.'] , function() {

    //store update and delete categories crud with livewire
    Route::get('/','backend\CategoryController@index')->name('index');
    Route::get('/create','backend\CategoryController@create')->name('create');
    Route::get('/{id}/edit','backend\CategoryController@edit')->name('edit');
    Route::get('/{id}','backend\CategoryController@category')->name('info');

});

//products routes
Route::group(['middleware'=>['admin','admin.verified'], 'prefix'=>'products', 'as'=>'product.'] , function() {

    //post routes for products crud not written because of using livewire
    Route::get('/','backend\ProductController@index')->name('index');
    Route::get('/reviews','backend\ProductController@reviews')->name('reviews');
    Route::get('/create','backend\ProductController@create')->name('create');
    Route::get('/{id}/edit','backend\ProductController@edit')->name('edit');
    Route::post('/{id}/delete','backend\ProductController@destroy')->name('delete');
    Route::get('/{id}','backend\ProductController@product')->name('info');
    Route::post('/{id}/image/add','backend\ProductController@image_add')->name('image_add');
    Route::post('/{id}/image/{image}/edit','backend\ProductController@image_update')->name('image_edit');
    Route::post('/{id}/image/{image}/delete','backend\ProductController@image_destroy')->name('image_delete');

});

//products store routes
Route::group(['middleware'=>['admin','admin.verified'], 'prefix'=>'products_store', 'as'=>'ProductStore.'] , function() {

    Route::get('/','backend\ProductStoreController@index')->name('index');
    Route::get('/{prod_id}/{prod_name}/','backend\ProductStoreController@product_history')->name('product_history');
    Route::get('/add','backend\ProductStoreController@add_quantity')->name('add')->middleware('admin.pages');
    Route::get('/{prod}/edit/{qty_id}','backend\ProductStoreController@edit_quantity')->name('edit')->middleware('admin.pages');
    Route::post('/{id}/delete','backend\ProductStoreController@destroy')->name('delete')->middleware('admin.pages');

});

//orders routes
Route::group(['middleware'=>['admin','admin.verified'], 'prefix'=>'orders', 'as'=>'order.'] , function() {

    Route::get('/','backend\OrderController@index')->name('index');
    Route::get('/{id}','backend\OrderController@show')->name('info');
    Route::post('/{id}/accept/{editor}','backend\OrderController@accept_order')->name('accept');
    Route::post('/{id}/cancel','backend\OrderController@destroy')->name('cancel');

});

//Editors routes
Route::group(['middleware'=>['admin','admin.pages','admin.verified'], 'prefix'=>'editors', 'as'=>'editor.'] , function() {

    Route::get('/','backend\EditorController@index')->name('index');
    Route::get('/create','backend\EditorController@create')->name('create');
    Route::get('/{id}/edit','backend\EditorController@edit')->name('edit');
    Route::post('/{id}/edit','backend\EditorController@update');
    Route::post('/{id}/delete','backend\EditorController@destroy')->name('delete');

});

//logs routes
Route::group(['middleware'=>['admin','admin.pages','admin.verified'], 'prefix'=>'logs', 'as'=>'DashLogs.'] , function() {

    Route::get('/','backend\LogsController@index')->name('index');
    Route::post('/delete','backend\LogsController@destroy')->name('delete');

});

//slider routes
Route::group(['middleware'=>['admin','admin.verified'], 'prefix'=>'slider', 'as'=>'slider.'] , function() {

    //store and update slider with livewire
    Route::get('/','backend\SliderController@index')->name('index');
    Route::get('/create','backend\SliderController@create')->name('create');
    Route::get('/{id}/edit','backend\SliderController@edit')->name('edit');
    Route::post('/{id}/delete','backend\SliderController@destroy')->name('delete');

});

//home page ads routes
Route::group(['middleware'=>['admin','admin.verified'], 'prefix'=>'banners', 'as'=>'Banner.'] , function() {

    //post routes for banners crud are set by livewire
    Route::get('/','backend\BannerController@index')->name('index');
    Route::get('/create','backend\BannerController@create')->name('create');
    Route::get('/{id}/edit','backend\BannerController@edit')->name('edit');
    Route::post('/{id}/delete','backend\BannerController@destroy')->name('delete');

});

//settings routes
Route::group(['middleware'=>['admin','admin.verified','admin.pages'], 'prefix'=>'setting', 'as'=>'setting.'] , function() {

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
Route::group(['middleware'=>['admin','admin.verified'], 'prefix'=>'states', 'as'=>'state.'] , function() {

    Route::get('/','backend\StateController@index')->name('index');
    Route::get('/create','backend\StateController@create')->name('create');
    Route::post('/{id}/edit','backend\StateController@update')->name('update');
    Route::post('/{id}/delete','backend\StateController@destroy')->name('delete')->middleware('admin.pages');
});

//edit user profile
Route::group(['middleware'=>['admin','admin.verified'], 'prefix'=>'profile', 'as'=>'profile.'] , function() {

    Route::get('/{id}/{name}','backend\ProfileController@index')->name('index');
    Route::get('/{id}/{name}/edit','backend\ProfileController@edit')->name('edit');
    Route::post('/{id}/{name}/edit','backend\ProfileController@update');
});

//admin auth routes
Route::group(['as'=>'AdminAuth.'] , function() {

    Route::get('login', 'AdminAuth\LoginController@LoginForm')->name('LoginForm');
    Route::post('login', 'AdminAuth\LoginController@login');
    Route::post('logout', 'AdminAuth\LoginController@logout')->name('logout');

});

//admin auth forget password routes
Route::group(['prefix'=>'password', 'as'=>'AdminPassword.'] , function() {

    Route::get('/forgot', 'AdminAuth\ForgotPasswordController@forgotPasswordForm')->name('forgot');
    Route::post('/forgot', 'AdminAuth\ForgotPasswordController@sendResetLink')->name('email');
    Route::get('/reset/{hash}/{email}', 'AdminAuth\ResetPasswordController@resetPasswordForm')->name('reset');
    Route::post('/reset/{hash}/{email}', 'AdminAuth\ResetPasswordController@resetPassword');

});

//admin auth verify email
Route::group(['prefix'=>'email', 'as'=>'AdminAuth.'] , function() {

    Route::get('verify', 'AdminAuth\VerificationController@verify_page')->name('notVerified')->middleware('admin');
    Route::post('verify', 'AdminAuth\VerificationController@resend')->name('resend')->middleware('admin');
    Route::get('verify_user/{id}/{hash}', 'AdminAuth\VerificationController@verify')->name('verify');

});