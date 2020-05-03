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

Route::get('/userLoginPage','User\UserLoginController@userLoginPage')->name('user.userLoginPage');
Route::get('/userLoginCheck','User\UserLoginController@userLoginCheck')->name('user.userLoginCheck');
Route::get('/userLogout','User\UserLoginController@userLogout')->name('user.userLogout');

Route::get('/index','User\UserController@index')->name('user.index');


// Admin Panel

Route::get('/admin','Admin\AdminController@adminIndex');
Route::get('/admin/userList','Admin\UserController@userList')->name('admin.userList');
Route::get('/admin/getAllUser','Admin\UserController@getAllUser')->name('admin.getAllUser');
Route::post('/admin/addUser','Admin\UserController@addUser')->name('admin.addUser');
Route::get('/admin/editUser','Admin\UserController@editUser')->name('admin.editUser');
Route::post('/admin/updateUser','Admin\UserController@updateUser')->name('admin.updateUser');
Route::post('/admin/deleteUser','Admin\UserController@deleteUser')->name('admin.deleteUser');