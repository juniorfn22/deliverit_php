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

    Route::apiResource('competition', '\App\Http\Controllers\CompetitionController');
    Route::apiResource('runner', '\App\Http\Controllers\RunnerController');
    Route::apiResource('result', '\App\Http\Controllers\ResultController');
    Route::post('runner/add_runner_to_competition','App\Http\Controllers\RunnerController@addRunnerToCompetition');



