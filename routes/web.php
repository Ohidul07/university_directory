<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.app');
});

Auth::routes(['registration' => false]);

Route::prefix('category')->group(function(){
    Route::get('list','bsmrau\CategoryController@index');
    Route::get('create','bsmrau\CategoryController@create');
    Route::post('store','bsmrau\CategoryController@store');
    Route::get('edit/{id}','bsmrau\CategoryController@edit');
    Route::post('update','bsmrau\CategoryController@update');
    Route::get('delete/{id}','bsmrau\CategoryController@destroy');
});

Route::prefix('subcategory')->group(function(){
    Route::get('list','bsmrau\SubCategoryController@index');
    Route::get('create','bsmrau\SubCategoryController@create');
    Route::post('store','bsmrau\SubCategoryController@store');
    Route::get('edit/{id}','bsmrau\SubCategoryController@edit');
    Route::post('update','bsmrau\SubCategoryController@update');
    Route::get('delete/{id}','bsmrau\SubCategoryController@destroy');
});

Route::prefix('subsubcategory')->group(function(){
    Route::get('list','bsmrau\SubSubCategoryController@index');
    Route::get('create','bsmrau\SubSubCategoryController@create');
    Route::post('store','bsmrau\SubSubCategoryController@store');
    Route::get('edit/{id}','bsmrau\SubSubCategoryController@edit');
    Route::post('update','bsmrau\SubSubCategoryController@update');
    Route::get('delete/{id}','bsmrau\SubSubCategoryController@destroy');
    Route::get('/getSubCategory/{id}', 'bsmrau\SubSubCategoryController@getSubCategory');

});
