<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\JwtLoginController;
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

Route::get('/user/login',  [JwtLoginController::class, 'login']);
Route::middleware(['jwt_auth'])->group(function(){
    Route::get('/user/info', [JwtLoginController::class, 'info']);
});

Route::get('/', function () {
    return view('welcome');
});