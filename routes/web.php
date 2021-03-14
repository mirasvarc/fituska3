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

Route::get('/', 'HomeController@index');

Route::get('/app', function () {
    return view('layouts/app');
});

Route::resource('user' , 'UserController' )->middleware('auth');
Route::delete('users/{id}', 'UserController@destroy')->middleware('auth');
Route::post('user.addRole', 'UserController@addRole')->name('addRole')->middleware('auth');
Route::post('user.changeSettings', 'UserController@changeSettings')->name('changeSettings')->middleware('auth');
Route::post('user.removeRole', 'UserController@removeRole')->name('removeRole')->middleware('auth');
Route::post('user.followCourse', 'UserController@followCourse')->name('followCourse')->middleware('auth');
Route::post('user.unfollowCourse', 'UserController@unfollowCourse')->name('unfollowCourse')->middleware('auth');

Route::resource('courses', 'CourseController')
        ->except('show')
        ->middleware('auth');

Route::get('course/{code}/topic/{id}', 'TopicController@show')->name('topic')->middleware('auth');
Route::post('course/{code}/create-topic', 'TopicController@store')->name('create-topic')->middleware('auth');
Route::get('course/{code}/topic/{id}/delete', 'TopicController@destroy')->name('delete-topic')->middleware('auth');
Route::get('course/{code}', 'CourseController@show')->name('course')->middleware('auth');
Route::get('course/{code}/files', 'CourseController@showFiles')->name('show.files')->middleware('auth');

Route::resource('posts', 'PostController')
        ->except('show', 'create')
        ->middleware('auth');

Route::get('course/{code}/topic/{topic_id}/create-post', 'PostController@create')->name('create-post')->middleware('auth');

Route::get('post/{code}/{id}/edit', 'PostController@edit')->name('edit-post')->middleware('auth');
Route::get('post/{code}/{id}', 'PostController@show')->name('post')->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'AdminPanelController@all_users')->name('users')->middleware('auth');

Route::get('/kontakty', 'UserController@contacts')->name('contacts')->middleware('auth');


Route::get('/forum', 'ForumController@index')->name('forum')->middleware('auth');
Route::get('forum/{id}', 'ForumController@show')->name('forum.show')->middleware('auth');
Route::post('forum/create-topic', 'TopicController@store')->name('create-topic')->middleware('auth');
Route::get('forum/topic/{id}/create-post', 'PostController@forumCreate')->name('create-forum-post')->middleware('auth');

Route::get('/vote', 'UserController@voteIndex')->name('voteIndex')->middleware('auth');
Route::post('/vote', 'UserController@vote')->name('voteIndex')->middleware('auth');

//admin

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminPanelController@index')->name('adminIndex')->middleware('auth'); //TODO: user have to be admin
    Route::get('/modules', 'AdminPanelController@modulesIndex')->name('modulesIndex')->middleware('auth');
    Route::post('.installModule', 'AdminPanelController@installModule')->name('installModule')->middleware('auth');
    Route::post('.uninstallModule', 'AdminPanelController@uninstallModule')->name('uninstallModule')->middleware('auth');
    Route::get('/vote', 'AdminPanelController@voteIndex')->name('voteIndex')->middleware('auth');
    Route::post('voteYes', 'AdminPanelController@voteYes')->name('voteYes')->middleware('auth');
    Route::post('voteNo', 'AdminPanelController@voteNo')->name('voteNo')->middleware('auth');
});



Route::get('add-comment-form-submit', 'CommentController@index');
Route::post('add-comment-form-submit', 'CommentController@store');

Route::post('open-post', 'PostController@openPost');

Route::get('/hromadne', 'ModuleController@showMultiMsg');

Route::post('/file/upload', 'CourseController@uploadFile')->name('file.upload')->middleware('auth');
Route::post('/exam/upload', 'CourseController@uploadExam')->name('exam.upload')->middleware('auth');

Route::get('/search','SearchController@search');

Route::post('multimsg/send', 'ModuleController@sendFbMultimsg')->name('send-fb-multimsg')->middleware('auth');

Route::post('/chooseAdmin', 'UserController@chooseAdmin')->name('chooseAdmin')->middleware('auth');
