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

Route::group(["prefix" => "v1"], function (){
    Route::post("topsecret", "App\Http\Controllers\SatelliteController@topSecret");
});

Route::group(["prefix" => "v2"], function (){
    Route::post("topsecret_split/{satellite_name}", "App\Http\Controllers\SatelliteController@topSecretSplit");
    Route::get('topsecret_split', "App\Http\Controllers\SatelliteController@getTopSecretSplit");
});
