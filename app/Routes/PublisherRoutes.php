<?php

Route::group(['prefix'=>'publishers', 'middleware' =>'auth'], function(){
	Route::get('','PublisherController@index')->name('publishers');
	Route::get('index','PublisherController@index')->name('publishers.index');
	Route::get('create', 'PublisherController@create')->name('publishers.create');
	Route::post('store', 'PublisherController@store')->name('publishers.store');
	Route::get('show/{publisher}', 'PublisherController@show')->name('publishers.show');
	Route::get('edit/{publisher}', 'PublisherController@edit')->name('publishers.edit');
	Route::post('update/{publisher}', 'PublisherController@update')->name('publishers.update');
	Route::post('destroy/{publisher}', 'PublisherController@destroy')->name('publishers.destroy');
});
