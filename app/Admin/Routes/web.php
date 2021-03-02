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
# prefix admin 值可以改为 hyadmin
Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index');
    Route::get('/aja', 'AdminController@aja');
    Route::get('/show/{id}', 'AdminController@show');
});
