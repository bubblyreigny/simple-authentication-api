<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('register', '\App\Http\Controllers\API\AuthController@register')->name('register');
Route::post('login', '\App\Http\Controllers\API\AuthController@login')->name('login');

Route::middleware('auth:api')->group(function() {
    Route::get('user', '\App\Http\Controllers\API\UserController@index')->name('index');
    Route::post('user/store', '\App\Http\Controllers\API\UserController@store')->name('store');
    Route::get('user/{id}', '\App\Http\Controllers\API\UserController@show')->name('show');
    Route::post('user/{id}/update', '\App\Http\Controllers\API\UserController@update')->name('update');
});

