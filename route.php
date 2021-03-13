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

//untuk melihat yang available
php artisan route:list
  
  //semua route ini harus melalui auth
  Route::group(['middleware'=>'auth'], function(){
   Route::get('blog', 'BlogController@index');
   Route::get('kontak', 'BlogController@kontak');
   Route::get('profil', 'BlogController@profil');
});

//dengan resource
Route::resource('user', 'UserController');

//langsung ke views
Route::view('/index', 'index')->name('index');
