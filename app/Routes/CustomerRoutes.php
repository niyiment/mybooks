<?php

Route::group(['prefix'=>'customers', 'middleware' =>'auth'], function(){
	Route::get('','CustomerController@index')->name('customers');
	Route::get('index','CustomerController@index')->name('customers.index');
	Route::get('create', 'CustomerController@create')->name('customers.create');
	Route::post('store', 'CustomerController@store')->name('customers.store');
	Route::get('show/{customer}', 'CustomerController@show')->name('customers.show');
	Route::get('edit/{customer}', 'CustomerController@edit')->name('customers.edit');
	Route::post('update/{customer}', 'CustomerController@update')->name('customers.update');
	Route::post('destroy/{customer}', 'CustomerController@destroy')->name('customers.destroy');
});
