<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::post('auth/login', '\Domain\Auth\Controller@login');
Route::post('auth/logout', '\Domain\Auth\Controller@logout');

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::resource('client', '\Domain\Client\Controller');
});

Route::group(['prefix' => 'clients/', 'middleware' => 'client'], function () {
    Route::post('auth/login', '\Domain\Auth\Controller@login');
});
