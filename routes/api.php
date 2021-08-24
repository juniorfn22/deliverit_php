<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

    Route::apiResource('corredor', '\App\Http\Controllers\CorredorController');
    Route::apiResource('prova', '\App\Http\Controllers\ProvaController');
    Route::post('corredor/incluirCorredor','App\Http\Controllers\CorredorController@incluirCorredor');



