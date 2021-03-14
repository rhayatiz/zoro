<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function(){
    Route::get('init','AppController@init');
    Route::get('test','AppController@test');

    Route::post('login', 'AppController@login');
    Route::post('register', 'AppController@register');
    Route::post('logout', 'AppController@logout');
});

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
