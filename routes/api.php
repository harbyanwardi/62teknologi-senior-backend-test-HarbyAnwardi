<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use Illuminate\Support\Facades\Redis;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'UserController@login');

Route::get('business/search', 'BusinessController@index');
Route::post('business', 'BusinessController@store');
Route::put('business/{id}', 'BusinessController@update');
Route::get('business/{id}', 'BusinessController@show');
Route::delete('business/{id}', 'BusinessController@destroy');

Route::get('category', 'CategoryController@index');




