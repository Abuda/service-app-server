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

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');

Route::get('/professionals', 'ProfessionalController@index');
Route::get('/professionals/{user}', 'ProfessionalController@show');

Route::middleware('auth:api')->group(function () {

    Route::put('/user', 'AuthController@update');

    Route::post('/professionals/{user}/reviews', 'ReviewController@create');

});

Route::fallback(function () {
    return 1;
});
