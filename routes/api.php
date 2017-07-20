<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::namespace('Api')->group(function () {
    Route::resource('appointments', 'AppointmentController');
    Route::get('departments/dates/{id}/{date?}', 'DepartmentController@availableDates');
    Route::get('departments', 'DepartmentController@index');

    Route::get('departments/show/{id}', 'DepartmentController@show');
    Route::get('masters/dates/{id}/{date?}', 'MasterController@availableDates');
    Route::get('clients/search', 'ClientController@search');

//Route::post('departments', 'DepartmentController@create');
//Route::put('departments/{id}', 'DepartmentController@update');
//Route::delete('departments/{id}', 'DepartmentController@delete');

});

