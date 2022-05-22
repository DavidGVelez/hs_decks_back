<?php

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

Route::get('', function () {
    return response()->json('Ok', 200);
});

Route::get('/ping', function () {
    return response()->json('Pong', 200);
});

Route::prefix('bnet')->middleware('bnet')->group(function () {

    Route::group(['prefix' => '/cards'], function () {

        Route::get('/', 'CardController@find_all');

        Route::get('/{idOrSlug}', 'CardController@find_one');
    });

    Route::group(['prefix' => '/cardbacks'], function () {

        Route::get('/', 'CardbackController@find_all');

        Route::get('/{idOrSlug}', 'CardbackController@find_one');
    });
});
