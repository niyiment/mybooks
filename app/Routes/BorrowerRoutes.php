<?php

Route::group(['prefix'=>'borrowers', 'middleware' =>'auth'], function(){
	Route::get('','BorrowerController@index')->name('borrowers');
	Route::get('index','BorrowerController@index')->name('borrowers.index');
	Route::get('create', 'BorrowerController@create')->name('borrowers.create');
	Route::post('store', 'BorrowerController@store')->name('borrowers.store');
	Route::get('show/{borrower}', 'BorrowerController@show')->name('borrowers.show');
	Route::get('edit/{borrower}', 'BorrowerController@edit')->name('borrowers.edit');
	Route::post('update/{borrower}', 'BorrowerController@update')->name('borrowers.update');
	Route::post('destroy/{borrower}', 'BorrowerController@destroy')->name('borrowers.destroy');
	Route::get('export-excel', 'BorrowerController@exportToExcel')->name('borrowers.export-excel');
	Route::get('excel', 'BorrowerController@exportExcel')->name('borrowers.excel');
});
