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

Route::prefix('user')->group(function () {
    Route::get('/', 'Api\UserController@all');
    Route::post('create', 'Api\UserController@create');
    Route::get('{user_id}', 'Api\UserController@show');
    Route::put('{user_id}', 'Api\UserController@update');
});
