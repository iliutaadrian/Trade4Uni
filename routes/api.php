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

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'UserController@forgotPassword');
    Route::post('password/reset', 'UserController@changePassword');
});

Route::group(['middleware' => 'jwt.auth'], function ($router) {
    Route::post('password', 'UserController@changePasswordUser');

    Route::get('customers', 'CustomersController@all');
    Route::get('customers/{id}', 'CustomersController@get');
    Route::post('customers/new', 'CustomersController@new');

    Route::post('logout', 'AuthController@logout');
});