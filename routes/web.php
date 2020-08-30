<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/user-registration', 'Auth\UserRegistrationController@showRegistrationForm')->name('user-registration')->middleware('auth');
Route::post('/user-registration', 'Auth\UserRegistrationController@saveUser')->name('user-save')->middleware('auth');
Route::get('/user-list', 'Auth\UserRegistrationController@userList')->name('user-list')->middleware('auth');



