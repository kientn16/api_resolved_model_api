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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('common/{modelName}', 'Api\ApiController@store')->name('store');
Route::get('common/{modelName}', 'Api\ApiController@index')->name('getAll');
Route::get('common/{modelName}/{column}/{val}', 'Api\ApiController@showBy')->name('getByAll');
Route::get('common/{modelName}/{skip}/{take}', 'Api\ApiController@getDataPagination')->name('getPagination');
Route::delete('common/{modelName}/{id}', 'Api\ApiController@destroy')->name('destroy');
Route::get('common/{modelName}/{id}', 'Api\ApiController@show')->name('show');
Route::put('common/{modelName}/{id}', 'Api\ApiController@update')->name('update');

