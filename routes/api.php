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
 
        Route::post('login', 'Auth\API\AuthController@login')->name('login');
        Route::post('register', 'Auth\API\AuthController@register')->name('register');
        Route::get('logout', 'Auth\API\AuthController@logout');
        Route::get('address', 'AddressController@index');
        Route::post('profile', 'UserController@profile');
        Route::post('update', 'UserController@update');
        Route::post('forgot', 'Auth\API\AuthController@forgot');
        Route::post('user/search', 'UserController@search_User');



        Route::group(['prefix' => 'foodB'], function () {
            Route::post('burguer', 'BurguerController@burguer');
            Route::post('create/burguer', 'BurguerController@store');
            Route::put('edit/burguer/{id}', 'BurguerController@update');
            Route::delete('{id}', 'BurguerController@destroy');
        });

         Route::group(['prefix' => 'foodI'], function () {
            Route::post('italian', 'ItalianController@italian');
            Route::post('create/italian', 'ItalianController@store');
            Route::put('edit/italian/{id}', 'ItalianController@update');
            Route::delete('{id}', 'ItalianController@destroy');
        });

        Route::group(['prefix' => 'foodJ'], function () {
            Route::post('japanese', 'JapaneseController@japanese');
            Route::post('create/japanese', 'JapaneseController@store');
            Route::put('edit/japanese/{id}', 'JapaneseController@update');
            Route::delete('{id}', 'JapaneseController@destroy');
        });

        Route::group(['prefix' => 'foodCh'], function () {
            Route::post('chinese', 'ChineseController@chinese');
            Route::post('create/chinese', 'ChineseController@store');
            Route::put('edit/chinese/{id}', 'ChineseController@update');
            Route::delete('{id}', 'ChineseController@destroy');
        });

        Route::group(['prefix' => 'foodIn'], function () {
            Route::post('indian', 'IndianController@indian');
            Route::post('create/indian', 'IndianController@store');
            Route::put('edit/indian/{id}', 'IndianController@update');
            Route::delete('{id}', 'IndianController@destroy');
        });

        Route::group(['prefix' => 'foodT'], function () {
            Route::post('traditional', 'TraditionalController@traditional');
            Route::post('create/traditional', 'TraditionalController@store');
            Route::put('edit/traditional/{id}', 'TraditionalController@update');
            Route::delete('{id}', 'TraditionalController@destroy');
        });

        Route::group(['prefix' => 'foodA'], function () {
            Route::post('arabian', 'ArabianController@arabian');
            Route::post('create/arabian', 'ArabianController@store');
            Route::put('edit/arabian/{id}', 'ArabianController@update');
            Route::delete('{id}', 'ArabianController@destroy');
            
        });

        Route::group(['prefix' => 'foodM'], function () {
            Route::post('mexican', 'MexicanController@mexican');
            Route::post('create/mexican', 'MexicanController@store');
            Route::put('edit/mexican/{id}', 'MexicanController@update');
            Route::delete('{id}', 'MexicanController@destroy');
        });

        Route::group(['prefix' => 'foodK'], function () {
            Route::post('korean', 'KoreanController@korean');
            Route::post('create/korean', 'KoreanController@store');
            Route::put('edit/korean/{id}', 'KoreanController@update');
            Route::delete('{id}', 'KoreanController@destroy');
        });

         Route::group(['prefix' => 'foodP'], function () {  //pollo
            Route::post('chicken', 'ChickenController@chicken');
            Route::post('create/chicken', 'ChickenController@store');
            Route::put('edit/chicken/{id}', 'ChickenController@update');
            Route::delete('{id}', 'ChickenController@destroy');
        });

          Route::group(['prefix' => 'foodV'], function () { //vegetarian
            Route::post('vegetarian', 'VegetarianController@vegetarian');
            Route::post('create/vegetarian', 'vegetarianController@store');
            Route::put('edit/vegetarian/{id}', 'VegetarianController@update');
            Route::delete('{id}', 'VegetarianController@destroy');
        });

          Route::group(['prefix' => 'foodVe'], function () { //vegan
            Route::post('vegan', 'VeganController@vegan');
            Route::post('create/vegan', 'VeganController@store');
            Route::put('edit/vegan/{id}', 'VegetarianController@update');
            Route::delete('{id}', 'VeganController@destroy');
        });

         Route::group(['prefix' => 'foodPi'], function () { //pizza
            Route::post('pizza', 'PizzaController@pizza');
            Route::post('create/pizza', 'PizzaController@store');
            Route::put('edit/pizza/{id}', 'PizzaController@update');
            Route::delete('{id}', 'PizzaController@destroy');
        });

         Route::group(['prefix' => 'foodD'], function () {
            Route::post('drink', 'DrinkController@drink');
            Route::post('create/drink', 'DrinkController@store');
            Route::put('edit/drink/{id}', 'DrinkController@update');
            Route::delete('{id}', 'DrinkController@destroy');
        });

         Route::group(['prefix' => 'foodE'], function () {
            Route::post('extra', 'ExtraController@extra');
            Route::post('create/extra', 'ExtraController@store');
            Route::put('edit/extra/{id}', 'ExtraController@update');
            Route::delete('{id}', 'ExtraController@destroy');
        });

         Route::group(['prefix' => 'foodS'], function () {
            Route::post('salad', 'SaladController@salad');
            Route::post('create/salad', 'SaladController@store');
            Route::put('edit/salad/{id}', 'SaladController@update');
            Route::delete('{id}', 'SaladController@destroy');
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::get('order/day', 'OrderController@index');
            Route::post('postulate/{id}', 'OrderController@assigment');
            Route::post('food', 'OrderController@food');
            Route::post('create/pedido', 'OrderController@createOrder');
            Route::post('pedido/{id}', 'OrderController@store');  //decodifica el pedido y lo muestra
            Route::post('search', 'OrderController@search');
        });

         Route::group(['prefix' => 'providers'], function () {
            Route::get('proveedor', 'ProviderController@index');
        });




});