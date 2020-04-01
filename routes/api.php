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


// Register, Login
Route::group(['prefix' => 'auth'], function () {
 
        Route::post('login', 'Auth\API\AuthController@login');
        Route::post('register', 'Auth\API\AuthController@register');
        Route::get('logout', 'Auth\API\AuthController@logout');
   
        Route::get('address', 'AddressController@index');

        Route::group(['prefix' => 'food'], function () {
            Route::get('burguer/{id}', 'BurguerController@index');
        });
});