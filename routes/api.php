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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', 'UserController@login');

Route::post('users', 'UserController@create');

Route::get('searchkost', 'CustomerController@index');
Route::get('searchkost/{id}', 'CustomerController@detailKost');


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('users', 'UserController@index');

    Route::get('kost', 'OwnerController@index');
    Route::post('kost', 'OwnerController@create');
    Route::put('kost/{id}', 'OwnerController@update');
    Route::delete('kost/{id}', 'OwnerController@destroy');

    Route::post('availkost/{id}', 'CustomerController@askAvailabilityRoom');
});
