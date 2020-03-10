<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('Systemson\Blankboard\App\Controllers')->group(function () {
	Route::get('/', 'AdminController@index')->name('admin.home');
});