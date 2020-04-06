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
            Route::put('edit/burguer/{id}', 'BurguerController@editBurguer');
            Route::delete('{id}', 'BurguerController@destroy');
        });

         Route::group(['prefix' => 'foodI'], function () {
            Route::post('italian', 'ItalianController@italian');
            Route::post('create/italian', 'ItalianController@photoItalian');
            Route::put('edit/italian/{id}', 'ItalianController@editItalian');
            Route::delete('{id}', 'ItalianController@destroy');
        });

        Route::group(['prefix' => 'foodJ'], function () {
            Route::post('japanese', 'JapaneseController@japanese');
            Route::post('create/japanese', 'JapaneseController@photoJapanese');
            Route::put('edit/japanese/{id}', 'JapaneseController@editJapanese');
            Route::delete('{id}', 'JapaneseController@destroy');
        });

        Route::group(['prefix' => 'foodCh'], function () {
            Route::post('chinese', 'ChineseController@chinese');
            Route::post('create/chinese', 'ChineseController@photoChinese');
            Route::put('edit/chinese/{id}', 'ChineseController@editChinese');
            Route::delete('{id}', 'ChineseController@destroy');
        });

        Route::group(['prefix' => 'foodIn'], function () {
            Route::post('indian', 'IndianController@indian');
            Route::post('create/indian', 'IndianController@photoIndian');
            Route::put('edit/indian/{id}', 'IndianController@editIndian');
            Route::delete('{id}', 'IndianController@destroy');
        });

        Route::group(['prefix' => 'foodT'], function () {
            Route::post('traditional', 'TraditionalController@traditional');
            Route::post('create/traditional', 'TraditionalController@photoTraditional');
            Route::put('edit/traditional/{id}', 'TraditionalController@editTraditional');
            Route::delete('{id}', 'TraditionalController@destroy');
        });

        Route::group(['prefix' => 'foodA'], function () {
            Route::post('arabian', 'ArabianController@arabian');
            Route::post('create/arabian', 'ArabianController@photoArabian');
            Route::put('edit/arabian/{id}', 'ArabianController@editArabian');
            Route::delete('{id}', 'ArabianController@destroy');
            
        });

        Route::group(['prefix' => 'foodM'], function () {
            Route::post('mexican', 'MexicanController@mexican');
            Route::post('create/mexican', 'MexicanController@photoMexican');
            Route::put('edit/mexican/{id}', 'MexicanController@editMexican');
            Route::delete('{id}', 'MexicanController@destroy');
        });

        Route::group(['prefix' => 'foodK'], function () {
            Route::post('korean', 'KoreanController@korean');
            Route::post('create/korean', 'KoreanController@photoKorean');
            Route::put('edit/korean/{id}', 'KoreanController@editKorean');
            Route::delete('{id}', 'KoreanController@destroy');
        });

         Route::group(['prefix' => 'foodP'], function () {  //pollo
            Route::post('chicken', 'ChickenController@chicken');
            Route::post('create/chicken', 'ChickenController@photoChicken');
            Route::put('edit/chicken/{id}', 'ChickenController@editChicken');
            Route::delete('{id}', 'ChickenController@destroy');
        });

          Route::group(['prefix' => 'foodV'], function () { //vegetarian
            Route::post('vegetarian', 'VegetarianController@vegetarian');
            Route::post('create/vegetarian', 'vegetarianController@photoVegetarian');
            Route::put('edit/vegetarian/{id}', 'VegetarianController@editVegetarian');
            Route::delete('{id}', 'VegetarianController@destroy');
        });

          Route::group(['prefix' => 'foodVe'], function () { //vegan
            Route::post('vegan', 'VeganController@vegan');
            Route::post('create/vegan', 'VeganController@photoVegan');
            Route::put('edit/vegan/{id}', 'VegetarianController@editVegetarian');
            Route::delete('{id}', 'VeganController@destroy');
        });

         Route::group(['prefix' => 'foodPi'], function () { //pizza
            Route::post('pizza', 'PizzaController@pizza');
            Route::post('create/pizza', 'PizzaController@photoPizza');
            Route::put('edit/pizza/{id}', 'PizzaController@editPizza');
            Route::delete('{id}', 'PizzaController@destroy');
        });

         Route::group(['prefix' => 'foodD'], function () {
            Route::post('drink', 'DrinkController@drink');
            Route::post('create/drink', 'DrinkController@photoDrink');
            Route::put('edit/drink/{id}', 'DrinkController@editDrink');
            Route::delete('{id}', 'DrinkController@destroy');
        });

         Route::group(['prefix' => 'foodE'], function () {
            Route::post('extra', 'ExtraController@extra');
            Route::post('create/extra', 'ExtraController@photoExtra');
            Route::put('edit/extra/{id}', 'ExtraController@editExtra');
            Route::delete('{id}', 'ExtraController@destroy');
        });

         Route::group(['prefix' => 'foodS'], function () {
            Route::post('salad', 'SaladController@salad');
            Route::post('create/salad', 'SaladController@photoSalad');
            Route::put('edit/salad/{id}', 'SaladController@editSalad');
            Route::delete('{id}', 'SaladController@destroy');
        });


});