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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('shopping-list','ShoppingList');

Route::resource('shopping-list/{shopping}/items','ItemController');

Route::post('shopping-list/{shopping}/items/{item}/completed', 'ItemController@completed')->name('items.completed');
