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

Route::get('/', 'HomeController@index')->middleware(['auth', 'validated']);

Route::get('/app', function () {
    return view('layouts/app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware(['auth', 'validated']);

Route::resource('user' , 'UserController' )->middleware(['auth', 'validated']);
Route::delete('users/{id}', 'UserController@destroy')->middleware(['auth', 'validated']);
Route::get('/users', 'AdminPanelController@all_users')->name('users')->middleware(['auth', 'validated']);
Route::get('/kontakty', 'UserController@contacts')->name('contacts')->middleware(['auth', 'validated']);
Route::get('users/import', 'UserController@importUsers')->name('import-users')->middleware(['auth', 'mod']);

Route::prefix('/user')->middleware(['auth', 'validated'])->group(function() {
    Route::post('.addRole', 'UserController@addRole')->name('addRole');
    Route::post('.changeSettings', 'UserController@changeSettings')->name('changeSettings');
    Route::post('.removeRole', 'UserController@removeRole')->name('removeRole');
    Route::post('.followCourse', 'UserController@followCourse')->name('followCourse');
    Route::post('.unfollowCourse', 'UserController@unfollowCourse')->name('unfollowCourse');
});

Route::resource('courses', 'CourseController')
        ->except('show')
        ->middleware(['auth', 'validated']);

Route::get('/courses/fetch_data', 'CourseController@fetch_data');

Route::prefix('/course')->middleware(['auth', 'validated'])->group(function() {
    Route::get('/{code}/topic/{id}', 'TopicController@show')->name('topic');
    Route::post('/{code}/create-topic', 'TopicController@store')->name('create-topic');
    Route::get('/{code}/topic/{id}/delete', 'TopicController@destroy')->name('delete-topic');
    Route::get('/{code}', 'CourseController@show')->name('course');
    Route::get('/{code}/files', 'CourseController@showFiles')->name('show.files');
    Route::get('/{code}/topic/{topic_id}/create-post', 'PostController@create')->name('create-post');
    Route::post('/calendar/update', 'CourseController@updateCourseCalendar')->name('update-course-calendar');
});

Route::get('/courses/import', 'CourseController@importCourses')->middleware(['mod', 'validated']);

Route::resource('posts', 'PostController')
        ->except('show', 'create')
        ->middleware(['auth', 'validated']);


Route::get('post/{code}/{id}/edit', 'PostController@edit')->name('edit-post')->middleware(['auth', 'validated']);
Route::get('post/{code}/{id}', 'PostController@show')->name('post')->middleware(['auth', 'validated']);
Route::post('/post/upvote', 'PostController@postUpvote')->name('post-upvote')->middleware(['auth', 'validated']);
Route::post('/post/downvote', 'PostController@postDownvote')->name('post-downvote')->middleware(['auth', 'validated']);

Route::prefix('/forum')->middleware(['auth', 'validated'])->group(function() {
    Route::get('/', 'ForumController@index')->name('forum');
    Route::get('/{id}', 'ForumController@show')->name('forum.show');
    Route::get('/{id}/post/{post_id}', 'ForumController@showPost')->name('forum.show-post');
    Route::post('/create-topic', 'TopicController@store')->name('create-topic');
    Route::get('/topic/{id}/create-post', 'PostController@forumCreate')->name('create-forum-post');
});

Route::get('/vote', 'UserController@voteIndex')->name('voteIndex')->middleware(['auth', 'validated']);
Route::post('/vote', 'UserController@vote')->name('voteIndex')->middleware(['auth', 'validated']);

//admin

Route::prefix('admin')->middleware(['auth', 'mod', 'validated'])->group(function () {

    Route::get('/', 'AdminPanelController@index')->name('adminIndex');

    // Modules
    Route::get('/modules', 'AdminPanelController@modulesIndex')->name('modulesIndex');
    Route::post('.installModule', 'AdminPanelController@installModule')->name('installModule');
    Route::post('.uninstallModule', 'AdminPanelController@uninstallModule')->name('uninstallModule');

    // Voting
    Route::get('/vote', 'AdminPanelController@voteIndex')->name('voteIndex');
    Route::post('voteYes', 'AdminPanelController@voteYes')->name('voteYes');
    Route::post('voteNo', 'AdminPanelController@voteNo')->name('voteNo');
    Route::post('createVote', 'AdminPanelController@createVote')->name('createVote');

});



Route::get('add-comment-form-submit', 'CommentController@index');
Route::post('add-comment-form-submit', 'CommentController@store');

Route::post('open-post', 'PostController@openPost');

Route::get('/hromadne', 'ModuleController@showMultiMsg')->middleware(['auth', 'validated']);
Route::get('/su-members', 'ModuleController@showSUMembers')->middleware(['auth', 'validated']);
Route::get('/su-contact', 'ModuleController@showSUContact')->middleware(['auth', 'validated']);
Route::get('/su-forms', 'ModuleController@showSUForms')->middleware(['auth', 'validated']);
Route::post('/su-contact/form-send', 'ModuleController@SUContactFormSave')->name('su-send-form')->middleware(['auth', 'validated']);
Route::post('/su/file/upload', 'ModuleController@uploadFile')->name('su.file.upload')->middleware(['auth', 'validated']);
Route::get('/su/files', 'ModuleController@showSUFiles')->name('su.files.show')->middleware(['auth', 'validated']);

Route::post('/file/upload', 'CourseController@uploadFile')->name('file.upload')->middleware(['auth', 'validated']);
Route::post('/exam/upload', 'CourseController@uploadExam')->name('exam.upload')->middleware(['auth', 'validated']);

Route::get('/search','SearchController@search');

Route::post('multimsg/fb/send', 'ModuleController@sendFbMultimsg')->name('send-fb-multimsg')->middleware(['auth', 'validated']);
Route::post('multimsg/dc/send', 'ModuleController@sendDCMultimsg')->name('send-dc-multimsg')->middleware(['auth', 'validated']);

Route::post('/chooseAdmin', 'UserController@chooseAdmin')->name('chooseAdmin')->middleware(['auth', 'validated']);

Route::get('/test', 'AdminPanelController@test')->name('test')->middleware(['mod', 'validated']);


Route::prefix('facebook')->group(function () {
    Route::get('get-posts', 'ModuleController@getFacebookPosts')->name('get-fb-posts')->middleware(['auth', 'validated']);
});

Route::prefix('calendar')->middleware(['auth', 'validated'])->group(function () {
    Route::post('/store', 'CalendarController@storeCalendar')->name('store-calendar');
    Route::post('/follow', 'CalendarController@followCalendar')->name('follow-calendar');
    Route::post('/unfollow', 'CalendarController@unfollowCalendar')->name('unfollow-calendar');
    Route::get('/update/all', 'CourseController@updateGoogleCalendars')->name('update-all-calendars');
    Route::post('/event/add', 'CalendarController@addNewEvent')->name('add-calendar-event');
    Route::post('/check', 'CalendarController@checkIfCalendarExist')->name('calendar-check');
});

Route::prefix('drive')->middleware(['auth', 'validated'])->group(function () {
    Route::post('/create', 'CourseController@createSharedFile')->name('create-shared-file');
});
