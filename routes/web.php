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

Route::prefix('forum')->group(function () {

    Route::get('/', 'ThreadController@index');
    Route::get('/{category}', 'ThreadController@index');

    Route::prefix('threads')->group(function () {

        Route::get('/filter', 'ThreadController@search');
        Route::get('/activity', 'ThreadController@activity');
        Route::get('/latest', 'ThreadController@latest');
        Route::get('/create', 'ThreadController@create');
        Route::get('/{category}/{thread}', 'ThreadController@show');
        Route::post('/', 'ThreadController@store');
        Route::post('/{category}/{thread}/replies', 'ReplyController@store');
        Route::post('/{thread}/like', 'FavoriteController@storeThread');

    });

    Route::post('replies/{reply}/like', 'FavoriteController@storeReply');
});

