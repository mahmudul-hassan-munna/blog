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
Route::get('/register-user', 'HomeController@registerUser');
Route::post('/register-user', 'HomeController@userCreate');

Route::get('/customers', 'HomeController@customers');
Route::get('/add-file', 'HomeController@addFile');
Route::post('/save-file', 'HomeController@saveFile');
Route::post('/delete-file', 'HomeController@deleteFile');



