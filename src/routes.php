<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware('web')
->group(function () {

    Route::namespace('App\Http\Controllers')
    ->group(function () {
        Auth::routes();
    });

    Route::prefix('admin')
    ->name('admin.')
    ->namespace('Systemson\Blankboard\App\Controllers')
    ->group(function () {

        Route::get('/', 'AdminHomeController@index')->name('home');


        //Route::namespace('Admin')->group(function () {
            Route::resource('/users', 'UsersController')->except(['show']);
            Route::resource('/roles', 'RolesController')->except(['show']);
            Route::resource('/permissions', 'PermissionsController')->except(['show', 'create', 'store', 'destroy']);
        //});
    });
});
