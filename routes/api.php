<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/contacts', 'ContactController@index');
    Route::get('/contacts/{contact}', 'ContactController@show');
    Route::post('/contacts', 'ContactController@store');
    Route::put('/contacts/{contact}', 'ContactController@update');
    Route::delete('/contacts/{contact}', 'ContactController@destroy');
});

