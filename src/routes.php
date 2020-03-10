<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Auth::routes();

Route::middleware('web')
->prefix('admin')
->name('admin.')
->namespace('Systemson\Blankboard\App\Controllers')
->group(function () {
    Route::get('/', 'AdminController@index')->name('home');


    Route::resource('/users', 'UsersController');
});