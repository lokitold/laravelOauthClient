<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('redirect', 'SocialAuthController@redirect')->name('loger.redirect');
Route::get('callback', 'SocialAuthController@callback');
Route::get('get/client', 'SocialAuthController@getClient');
Route::get('logout-lector', 'SocialAuthController@logout');

Route::get('test', 'SocialAuthController@test');




Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
