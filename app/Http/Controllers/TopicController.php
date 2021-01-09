<?php

namespace App\Http\Controllers;

use App\Topics;
use App\Post;
use App\Course;
use App\HasSeenPost;
use App\User;
use App\File;
use App\HasFile;

use Illuminate\Http\Request;

class TopicController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($code)
    {

        return view('posts/post_create', ['code' => $code]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = Course::where('code', $request->course_code)->first();
        $topic = new Topics();
        $topic->course_id = $course->id;
        $topic->name = $request->topic_name;
        $topic->save();

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code, $id)
    {
        $course = Course::where('code', $code)
            ->first();
        $posts = Post::where('topic_id', $id)->get();
        $user = User::find(auth()->user()->id);
        $userSettings = $user->userSettings()->first();

        return view('topics/topic', ['posts' => $posts, 'user_settings' => $userSettings->user_settings_json, 'user' => $user, 'course' => $course, 'topic_id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code, $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($code, $id)
    {
        $topic = Topics::find($id);
        $topic->delete();

        return redirect('/course/'.$code)->with('success', 'Uživatel byl úspešně smazán!');

    }


}
