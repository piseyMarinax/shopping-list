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
//Auth::routes();

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'API\UserAPIController@login');

Route::post('register', 'API\UserAPIController@register');

Route::resource('shopping-list','API\ShoppingAPIController');
Route::resource('shopping-list/{shopping}/items','API\ItemAPIController');
Route::post('shopping-list/{shopping}/items/{item}/completed', 'API\ItemAPIController@completed')->name('items.completed');


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::post('register', 'API\RegisterController@register');
//Route::post('login', 'API\RegisterController@login');
//
//Route::middleware('auth:api')->group( function () {
//    Route::resource('products', 'API\ProductController');
//});
