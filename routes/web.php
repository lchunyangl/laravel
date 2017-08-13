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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'IndexController@index')->name('index');
    Route::get('nav', 'IndexController@nav')->name('nav');
    Route::get('main', 'IndexController@main')->name('main');

    Route::resource('bumen', 'BumenController');
    Route::resource('kemu', 'KemuController');
    Route::resource('renyuan', 'RenyuanController');
    Route::resource('baoxiaolx', 'BaoxiaolxController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
