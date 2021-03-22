<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**************************************
 * Authentification & register
 */
Route::prefix('auth')->group(function(){
    Route::get('init','AppController@init');
    Route::get('test','AppController@test');

    Route::post('login', 'AppController@login');
    Route::post('register', 'AppController@register');
    Route::post('logout', 'AppController@logout');
});

Route::get('crypto/list', 'CryptocurrenciesController@list');


// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
