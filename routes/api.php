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

Route::get('/layer', 'Api\DirectoryController@index');
Route::get('/layer/{id}', 'Api\DirectoryController@subLayers');
Route::get('/sub_layer/{id}', 'Api\DirectoryController@subSubLayers');
Route::get('/sub_sub_layer/{id}', 'Api\DirectoryController@subSubSubLayers');