<?php

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('auth/logout', '\Domain\Auth\Controller@logout');
    Route::resource('client', '\Domain\Client\Controller');
});

Route::group(['prefix' => 'clients/', 'middleware' => 'client'], function () {
    Route::post('auth/login', '\Domain\Auth\Controller@login');
});
