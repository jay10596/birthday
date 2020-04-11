<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::post('/logout', function() {
    request()->session()->invalidate();
});

Route::post('/upload', 'ImageController@upload');

Route::get('/{any}', 'HomeController@index')->where('any', '.*');
