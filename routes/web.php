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
// Header And Footer Section
Route::get('/add-header-footer', 'HomePageController@addHeaderFooterForm')->name('add-header-footer');
Route::post('/add-header-footer', 'HomePageController@headerFooterSave')->name('header-footer-save');

Route::get('/manage-header-footer/{id}', 'HomePageController@manageHeaderFooter')->name('manage-header-footer');
Route::post('/header-footer-update', 'HomePageController@headerFooterUpdate')->name('header-footer-update');

// Slider Section Start
Route::get('/add-slide', 'SliderController@addSlide')->name('add-slide');
Route::post('/upload-slide', 'SliderController@uploadSlide')->name('upload-slide');

Route::get('/manage-slide', 'SliderController@manageSlide')->name('manage-slide');
Route::get('/slide-unpublished/{id}', 'SliderController@slideUnpublished')->name('slide-unpublished');
Route::get('/slide-published/{id}', 'SliderController@slidePublished')->name('slide-published');
Route::get('/slide-edit/{id}', 'SliderController@slideEdit')->name('slide-edit');
Route::post('/update-slide', 'SliderController@updateSlide')->name('update-slide');
Route::get('/slide-delete/{id}', 'SliderController@slideDelete')->name('slide-delete');

Route::get('/photo-gallery', 'SliderController@photoGallery')->name('photo-gallery');
// Slider Section End

// School Management Section Start
Route::get('/school/add', 'School\SchoolManagementController@addSchoolForm')->name('add-school');
Route::post('/school/add', 'School\SchoolManagementController@schoolSave')->name('school-save');
Route::get('/school/list', 'School\SchoolManagementController@schoolList')->name('school-list');
Route::get('/school/unpublished/{id}', 'School\SchoolManagementController@schoolUnpublished')->name('school-unpublished');
Route::get('/school/published/{id}', 'School\SchoolManagementController@schoolPublished')->name('school-published');
Route::get('/school/edit/{id}', 'School\SchoolManagementController@schoolEditForm')->name('school-edit');
Route::post('/school/update', 'School\SchoolManagementController@schoolUpdate')->name('school-update');
Route::get('/school/delete/{id}', 'School\SchoolManagementController@schoolDelete')->name('school-delete');
// School Management Section End

// Class Management Section Start
Route::get('/class/add', 'School\ClassManagementController@addClassForm')->name('add-class');
Route::post('/class/add', 'School\ClassManagementController@classSave')->name('class-save');
Route::get('/class/list', 'School\ClassManagementController@classList')->name('class-list');
Route::get('/class/unpublished/{id}', 'School\ClassManagementController@classUnpublished')->name('class-unpublished');
Route::get('/class/published/{id}', 'School\ClassManagementController@classPublished')->name('class-published');
Route::get('/class/edit/{id}', 'School\ClassManagementController@classEditForm')->name('class-edit');
Route::post('/class/update', 'School\ClassManagementController@classUpdate')->name('class-update');
Route::get('/class/delete/{id}', 'School\ClassManagementController@classDelete')->name('class-delete');
// Class Management Section End

// Batch Management Section Start
Route::get('/batch/add', 'School\BatchManagementController@addBatchForm')->name('add-batch');
Route::post('/batch/add', 'School\BatchManagementController@batchSave')->name('batch-save');
Route::get('/batch/class-wise-student-type', 'School\BatchManagementController@classWiseStudentType')->name('class-wise-student-type');
Route::get('/batch/list', 'School\BatchManagementController@batchList')->name('batch-list');
Route::get('/batch/list-by-ajax', 'School\BatchManagementController@batchListByAjax')->name('batch-list-by-ajax');
Route::get('/batch/unpublished', 'School\BatchManagementController@batchUnpublished')->name('batch-unpublished');
Route::get('/batch/published', 'School\BatchManagementController@batchPublished')->name('batch-published');
Route::get('/batch/edit/{id}', 'School\BatchManagementController@batchEdit')->name('batch-edit');
Route::post('/batch/update', 'School\BatchManagementController@batchUpdate')->name('batch-update');
Route::get('/batch/delete', 'School\BatchManagementController@batchDelete')->name('batch-delete');
// Batch Management Section End

// Student Type Management Section Start
Route::get('/student-type', 'School\StudentTypeController@index')->name('student-type');
Route::post('/student-type-add', 'School\StudentTypeController@studentTypeAdd')->name('student-type-add');
Route::get('/student-type-list', 'School\StudentTypeController@studentTypeList')->name('student-type-list');
Route::get('/student-type-unpublish', 'School\StudentTypeController@studentTypeUnpublish')->name('student-type-unpublish');
Route::get('/student-type-publish', 'School\StudentTypeController@studentTypePublish')->name('student-type-publish');
Route::post('/student-type-update', 'School\StudentTypeController@studentTypeUpdate')->name('student-type-update');
Route::get('/student-type-delete', 'School\StudentTypeController@studentTypeDelete')->name('student-type-delete');
// Student Type Management Section End

// Student Management Section Start
Route::get('/student/registration-form', 'Student\StudentController@studentRegistrationForm')->name('student-registration-form');
Route::get('/bring-student-type', 'Student\StudentController@bringStudentType')->name('bring-student-type');
Route::get('/batch-roll-form', 'Student\StudentController@batchRollForm')->name('batch-roll-form');
Route::post('/student/registration-form', 'Student\StudentController@studentSave')->name('student-save');
Route::get('/student/all-running-student-lsit', 'Student\StudentController@allRunningStudentLsit')->name('all-running-student-lsit');
Route::get('/student/class-selection-form', 'Student\StudentController@classSelectionForm')->name('class-selection-form');
Route::get('/student/class-wise-student-type', 'Student\StudentController@classWiseStudentType')->name('class-wise-student-type');
Route::get('/student/class-and-type-wise-student', 'Student\StudentController@classAndTypeWiseStudent')->name('class-and-type-wise-student');
// Student Management Section End


