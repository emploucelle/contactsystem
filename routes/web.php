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

Route::get('/thankyou','ContactController@thankyou');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contacts', 'ContactController@index');
Route::post('/save_contact', 'ContactController@create');
Route::get('/search','ContactController@search');
Route::get('/edit_contact{id}','ContactController@edit');
Route::post('/save_update', 'ContactController@update');
Route::get('delete_contact/{id}','ContactController@destroy');