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
Route::get('/user-profile/{userId}', 'Auth\UserRegistrationController@userProfile')->name('user-profile')->middleware('auth');
Route::get('/change-user-info/{id}', 'Auth\UserRegistrationController@changeUserInfo')->name('change-user-info')->middleware('auth');
Route::post('/user-info-update', 'Auth\UserRegistrationController@userInfoUpdate')->name('user-info-update')->middleware('auth');

