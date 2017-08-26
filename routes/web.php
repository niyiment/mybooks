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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/register','Auth\RegisterController@showRegistrationForm');
//products
require app_path('Routes/AuthorRoutes.php');

//require app_path('Routes/PublisherRoutes.php');

require app_path('Routes/BookRoutes.php');

require app_path('Routes/CustomerRoutes.php');

require app_path('Routes/BorrowerRoutes.php');