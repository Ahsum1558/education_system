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

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// Authentication
Route::get('/user-registration', 'Auth\UserRegistrationController@showRegistrationForm')->name('user-registration')->middleware('auth');
Route::post('/user-registration', 'Auth\UserRegistrationController@saveUser')->name('user-save')->middleware('auth');

Route::get('/user-list', 'Auth\UserRegistrationController@userList')->name('user-list')->middleware('auth');

Route::get('/user-profile/{userId}', 'Auth\UserRegistrationController@userProfile')->name('user-profile')->middleware('auth');

Route::get('/change-user-info/{id}', 'Auth\UserRegistrationController@changeUserInfo')->name('change-user-info')->middleware('auth');
Route::post('/user-info-update', 'Auth\UserRegistrationController@userInfoUpdate')->name('user-info-update')->middleware('auth');

Route::get('/change-user-avatar/{id}', 'Auth\UserRegistrationController@changeUserAvatar')->name('change-user-avatar')->middleware('auth');
Route::post('/update-user-photo', 'Auth\UserRegistrationController@updateUserPhoto')->name('update-user-photo')->middleware('auth');

Route::get('/change-user-password/{id}', 'Auth\UserRegistrationController@changeUserPassword')->name('change-user-password')->middleware('auth');
Route::post('/user-password-update', 'Auth\UserRegistrationController@userPasswordUpdate')->name('user-password-update')->middleware('auth');

// General Section
Route::get('/add-header-footer', 'HomePageController@addHeaderFooterForm')->name('add-header-footer');
Route::post('/add-header-footer', 'HomePageController@headerFooterSave')->name('header-footer-save');

Route::get('/manage-header-footer/{id}', 'HomePageController@manageHeaderFooter')->name('manage-header-footer');
Route::post('/header-footer-update', 'HomePageController@headerFooterUpdate')->name('header-footer-update');