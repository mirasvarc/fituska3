<?php

namespace App\Http\Controllers;

use App\Course;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::All();

        $subset = $courses->map(function ($course) {
            return collect($course)
                ->only(['id', 'code', 'full_name', 'study_year', 'type'])
                ->all();
        });


        return view('courses/courses', ['courses' => $subset->toJson()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $course = Course::where('code', $code)
            ->first();

        $posts = Post::where('course_id', $course->id)->get();

        $post_content = array();

        foreach($posts as $post){
            $post_content[] = $post->content;
        }

        $user = User::find(auth()->user()->id);

        $userSettings = $user->userSettings()->first();

        return view('courses/course_show', ['course' => $course, 'posts' => $posts, 'user_settings' => $userSettings->user_settings_json, 'content_json' => $post_content, 'user' => $user]);
    }

    public function showFiles($code){

        $course = Course::where('code', $code)
            ->first();

        $user = User::find(auth()->user()->id);
        $files = Course::getCourseFiles($course->id);

        return view('courses.course_files', ['course' => $course, 'user' => $user, 'files' => $files]);
    }
}
