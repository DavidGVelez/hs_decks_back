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

Route::get('/', function () {
    dd('testing');
});

Route::group(['prefix' => '/bnet'], function () {

    Route::get('/token/refresh', 'BnetController@refresh_access_token');
});


Route::group(['prefix' => '/cards'], function () {

    Route::get('/', 'CardController@find_all');

    Route::get('/{idOrSlug}', 'CardController@find_one');
});
