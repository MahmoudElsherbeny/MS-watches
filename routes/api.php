<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'=>['api', 'auth:admin-api'], 'namespace' => 'api'] , function() {

    Route::post('/products','ProductsController@index');
    Route::post('/product','ProductsController@ProductById');

});

Route::group(['prefix' => 'admin', 'middleware'=>['api'], 'namespace' => 'api\backend'] , function() {

    Route::post('/login','AuthController@login');
    Route::post('/logout','AuthController@logout')->middleware('auth:admin-api');

});

Route::group(['prefix' => 'user', 'middleware'=>['api'], 'namespace' => 'api\frontend'] , function() {

    Route::post('/login','AuthController@login');
    Route::post('/logout','AuthController@logout')->middleware('auth:user-api');

});
