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



Auth::routes();

// Route::post('/login', 'Auth\LoginController@login');
// Route::post('/logout', 'Auth\LoginController@logout');

// Route::post('/register', 'Auth\RegisterController@register');

Route::get('/getUser ', 'UserController@getUser');
Route::get('/JOFinit/{id}','JOFController@index');
Route::get('/logout ', 'UserController@logout');
Route::get('/userrole ', 'UserController@userrole');
// Route::get('/home ', 'HomeController@index')->name('home');
Route::get('/{vue?}', function () { return view('/home/home'); })->where('vue', '[\/\w\.-]*');


Route::post('/JOFupdateStatus','JOFController@updateStatus');

