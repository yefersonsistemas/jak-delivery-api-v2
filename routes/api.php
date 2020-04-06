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

        Route::group(['prefix' => 'foodB'], function () {
            Route::post('burguer', 'BurguerController@burguer');
            Route::post('create/burguer', 'BurguerController@photoBurguer');
        });

         Route::group(['prefix' => 'foodI'], function () {
            Route::post('italian', 'ItalianController@italian');
            Route::post('create/italian', 'ItalianController@photoItalian');
        });

        Route::group(['prefix' => 'foodJ'], function () {
            Route::post('japanese', 'JapaneseController@japanese');
            Route::post('create/japanese', 'JapaneseController@photoJapanese');
        });

        Route::group(['prefix' => 'foodCh'], function () {
            Route::post('chinese', 'ChineseController@chinese');
            Route::post('create/chinese', 'ChineseController@photoChinese');
        });

        Route::group(['prefix' => 'foodIn'], function () {
            Route::post('indian', 'IndianController@indian');
            Route::post('create/indian', 'IndianController@photoIndian');
        });

        Route::group(['prefix' => 'foodT'], function () {
            Route::post('traditional', 'TraditionalController@traditional');
            Route::post('create/traditional', 'TraditionalController@photoTraditional');
        });

        Route::group(['prefix' => 'foodA'], function () {
            Route::post('arabian', 'ArabianController@arabian');
            Route::post('create/arabian', 'ArabianController@photoArabian');
            Route::put('edit/arabian/{id}', 'ArabianController@editArabian');
            
        });

        Route::group(['prefix' => 'foodM'], function () {
            Route::post('mexican', 'MexicanController@mexican');
            Route::post('create/mexican', 'MexicanController@photoMexican');
        });

        Route::group(['prefix' => 'foodK'], function () {
            Route::post('korean', 'KoreanController@korean');
            Route::post('create/korean', 'KoreanController@photoKorean');
        });

         Route::group(['prefix' => 'foodP'], function () {  //pollo
            Route::post('chicken', 'ChickenController@chicken');
            Route::post('create/chicken', 'ChickenController@photoChicken');
        });

          Route::group(['prefix' => 'foodV'], function () { //vegetarian
            Route::post('vegetarian', 'VegetarianController@vegetarian');
            Route::post('create/vegetarian', 'vegetarianController@photoVegetarian');
        });

          Route::group(['prefix' => 'foodVe'], function () { //vegan
            Route::post('vegan', 'VeganController@vegan');
            Route::post('create/vegan', 'VeganController@photoVegan');
        });

         Route::group(['prefix' => 'foodPi'], function () { //pizza
            Route::post('pizza', 'PizzaController@pizza');
            Route::post('create/pizza', 'PizzaController@photoPizza');
        });

         Route::group(['prefix' => 'foodD'], function () {
            Route::post('drink', 'DrinkController@drink');
            Route::post('create/drink', 'DrinkController@photoDrink');
        });

         Route::group(['prefix' => 'foodE'], function () {
            Route::post('extra', 'ExtraController@extra');
            Route::post('create/extra', 'ExtraController@photoExtra');
        });

         Route::group(['prefix' => 'foodS'], function () {
            Route::post('salad', 'SaladController@salad');
            Route::post('create/salad', 'SaladController@photoSalad');
        });


});