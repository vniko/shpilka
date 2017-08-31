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
Route::group(['namespace' => 'Api', 'middleware' => 'api'], function () {
    Route::post('/auth/login', 'AuthController@login');
});

Route::group(['middleware' => 'jwt.auth', 'namespace'=> 'Api'],function () {
    Route::resource('appointments', 'AppointmentController');

    Route::get('clients/search', 'ClientController@search');

    Route::get('departments/dates/{id}/{date?}', 'DepartmentController@availableDates');
    Route::get('departments', 'DepartmentController@index');
    Route::get('departments/show/{id}', 'DepartmentController@show');

    Route::get('masters/dates/{id}/{date?}', 'MasterController@availableDates');

    Route::resource('orders', 'OrderController');

    Route::resource('products', 'ProductController');

//Route::post('departments', 'DepartmentController@create');
//Route::put('departments/{id}', 'DepartmentController@update');
//Route::delete('departments/{id}', 'DepartmentController@delete');

});

