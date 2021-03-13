<?php

//ini untuk membuat grup router
Route::group(['prefix' => 'product'], function() {
Route::get('/', 'ProductController@index');
Route::get('/new', 'ProductController@create');
Route::post('/', 'ProductController@save');
Route::get('/{id}', 'ProductController@edit');
Route::put('/{id}', 'ProductController@update');
Route::delete('/{id}', 'ProductController@destroy');
});
