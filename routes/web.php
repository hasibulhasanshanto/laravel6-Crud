<?php

Route::get('/', 'UserController@index')->name('user.index');
Route::get('/create', 'UserController@create')->name('user.create');
Route::post('/store', 'UserController@store')->name('user.store');
Route::get('/show/{id}', 'UserController@show')->name('user.show');
Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
Route::post('/update/{id}', 'UserController@update')->name('user.update');
Route::delete('/destroy/{id}', 'UserController@destroy')->name('user.destroy');
