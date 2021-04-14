<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
use App\Post;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/user/get/{id}', function($id) {
    return User::find($id);
});

Route::get('/posts/get/{code}', 'ApiController@getCoursePosts');

Route::get('/post/get/{id}', function($id){
    return Post::find($id);
});

Route::post('/post/create', 'ApiController@addPostFromDiscord');
