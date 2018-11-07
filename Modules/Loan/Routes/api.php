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

Route::prefix('user/{user_id}/loan')->group(function () {
    Route::get('/', 'Api\LoanController@listByUser');
    Route::post('/create', 'Api\LoanController@create');
    Route::get('/{loan_id}', 'Api\LoanController@show');
    Route::post('/{loan_id}/pay/{repayment_id}', 'Api\LoanController@payRepayment');
});
