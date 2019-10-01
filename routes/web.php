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
    return view('home');
})->middleware('auth');

Auth::routes(['registration' => false]);

Route::prefix('category')->middleware('auth')->group(function(){
    Route::get('list','Category\CategoryController@index');
    Route::get('create','Category\CategoryController@create');
    Route::post('store','Category\CategoryController@store');
    Route::get('edit/{id}','Category\CategoryController@edit');
    Route::post('update','Category\CategoryController@update');
    Route::get('delete/{id}','Category\CategoryController@destroy');
    Route::get('active/{id}','Category\CategoryController@active');
    Route::get('deactive/{id}','Category\CategoryController@deactive');
});

Route::prefix('subcategory')->middleware('auth')->group(function(){
    Route::get('list','Category\SubCategoryController@index');
    Route::get('create','Category\SubCategoryController@create');
    Route::post('store','Category\SubCategoryController@store');
    Route::get('edit/{id}','Category\SubCategoryController@edit');
    Route::post('update','Category\SubCategoryController@update');
    Route::get('delete/{id}','Category\SubCategoryController@destroy');
    Route::get('active/{id}','Category\SubCategoryController@active');
    Route::get('deactive/{id}','Category\SubCategoryController@deactive');
});

Route::prefix('subsubcategory')->middleware('auth')->group(function(){
    Route::get('list','Category\SubSubCategoryController@index');
    Route::get('create','Category\SubSubCategoryController@create');
    Route::post('store','Category\SubSubCategoryController@store');
    Route::get('edit/{id}','Category\SubSubCategoryController@edit');
    Route::post('update','Category\SubSubCategoryController@update');
    Route::get('delete/{id}','Category\SubSubCategoryController@destroy');
    Route::get('active/{id}','Category\SubSubCategoryController@active');
    Route::get('deactive/{id}','Category\SubSubCategoryController@deactive');
    Route::get('/getSubCategory/{id}', 'Category\SubSubCategoryController@getSubCategory');
    Route::get('/getSubSubCategory/{id}', 'Category\SubSubCategoryController@getSubSubCategory');
});

Route::prefix('designations')->middleware('auth')->group(function(){
    Route::get('list','Person\DesignationController@index');
    Route::get('create','Person\DesignationController@create');
    Route::post('store','Person\DesignationController@store');
    Route::get('edit/{id}','Person\DesignationController@edit');
    Route::post('update','Person\DesignationController@update');
    Route::get('delete/{id}','Person\DesignationController@destroy');
    Route::get('active/{id}','Person\DesignationController@active');
    Route::get('deactive/{id}','Person\DesignationController@deactive');
});

Route::prefix('persons')->middleware('auth')->group(function(){
    Route::get('list','Person\PersonController@index');
    Route::get('create','Person\PersonController@create');
    Route::post('store','Person\PersonController@store');
    Route::get('edit/{id}','Person\PersonController@edit');
    Route::post('update','Person\PersonController@update');
    Route::get('delete/{id}','Person\PersonController@destroy');
    Route::get('active/{id}','Person\PersonController@active');
    Route::get('deactive/{id}','Person\PersonController@deactive');
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});