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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes();

Route::resource('shopping-list','API\ShoppingAPIController');

Route::resource('shopping-list/{shopping}/items','API\ItemAPIController');

Route::post('shopping-list/{shopping}/items/{item}/completed', 'API\ItemAPIController@completed')->name('items.completed');
