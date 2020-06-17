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
    return view('home');
});

Route::get('/app', function () {
    return view('layouts/app');
});

Route::resource('user' , 'UserController' )->middleware('auth');
Route::delete('users/{id}', 'UserController@destroy')->middleware('auth');
Route::post('user.addRole', 'UserController@addRole')->name('addRole')->middleware('auth');
Route::post('user.removeRole', 'UserController@removeRole')->name('removeRole')->middleware('auth');

Route::resource('course', 'CourseController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'AdminPanelController@all_users')->name('users')->middleware('auth');

