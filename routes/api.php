<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Auth::loginUsingId(1, $remember = true);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(["middleware" => "token"], function () {
    Route::get("blogs", "BlogController@index");
    Route::get("blogs/{id}", "BlogController@show");
    Route::post('blogs', 'BlogController@store');
    Route::put('blogs/{id}', 'BlogController@update');
    Route::delete('blogs/{id}', 'BlogController@delete');
});
