<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '/'], function(){
    Route::get('/', function () {
        return view('welcome');
    });

    Route::group(['prefix' => '/post'], function(){
        Route::get('/', 'PostController@index')->name('post_index');
        Route::post('/create','PostController@create')->name('post_create');
        Route::get('/update/{id}','PostController@update')->name('post_update');
        Route::post('/store','PostController@store')->name('post_store');
        Route::post('/delete','PostController@delete')->name('post_delete');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
