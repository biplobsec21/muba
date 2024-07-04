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

Route::group(['namespace' => 'Api'], function() {	

Route::get('getallcontent/{start_limit}/{offset}', [
        'as' => 'api.getallcontent',
        'uses' => 'GetContentController@get_data'
    ]);

Route::get('getdata_by_category/{id}/{start_limit}/{offset}', [
        'as' => 'api.getallcontent',
        'uses' => 'GetContentController@getdata_by_category'
    ]);

});
