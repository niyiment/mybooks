<?php

Route::group(['prefix'=>'authors', 'middleware' =>'auth'], function(){
	Route::get('','AuthorController@index')->name('authors');
	Route::get('index','AuthorController@index')->name('authors.index');
	Route::get('create', 'AuthorController@create')->name('authors.create');
	Route::post('store', 'AuthorController@store')->name('authors.store');
	Route::get('show/{author}', 'AuthorController@show')->name('authors.show');
	Route::get('edit/{author}', 'AuthorController@edit')->name('authors.edit');
	Route::post('update/{author}', 'AuthorController@update')->name('authors.update');
	Route::post('destroy/{author}', 'AuthorController@destroy')->name('authors.destroy');
});
