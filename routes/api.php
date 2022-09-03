<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('login', [\App\Http\Controllers\ApiController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function () {
        return \Illuminate\Support\Facades\Auth::user();
    });
    Route::post('logout', [\App\Http\Controllers\ApiController::class, 'logout']);
});
