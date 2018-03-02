<?php

use Illuminate\Http\Request;
use App\City;
use App\District;
use App\Commune;
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
Route::group(['prefix' => 'addresses'], function (){
    Route::get('city', function(){
        return City::all();
    });
    Route::get('district/{cityId}', function($cityId){
        return City::find($cityId)->district;
    });
    Route::get('commune/{districtId}', function($districtId){
        return District::find($districtId)->commune;
    });
});
