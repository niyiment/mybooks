<?php

Route::group(['prefix'=>'books', 'middleware' =>'auth'], function(){
	Route::get('','BookController@index')->name('books');
	Route::get('index','BookController@index')->name('books.index');
	Route::get('create', 'BookController@create')->name('books.create');
	Route::post('store', 'BookController@store')->name('books.store');
	Route::get('show/{book}', 'BookController@show')->name('books.show');
	Route::get('edit/{book}', 'BookController@edit')->name('books.edit');
	Route::post('update/{book}', 'BookController@update')->name('books.update');
	Route::post('destroy/{book}', 'BookController@destroy')->name('books.destroy');
});
