<?php

namespace App\Http\Controllers;

use App\Course;
use App\Post;
use App\User;
use App\Topics;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $course = Course::where('code', $code)
            ->first();

        $topics = Topics::where('course_id', $course->id)->get();

        $user = User::find(auth()->user()->id);

        $userSettings = $user->userSettings()->first();

        $files = Course::getCourseFiles($course->id);

        return view('courses/course_show', ['course' => $course, 'user_settings' => $userSettings->user_settings_json, 'user' => $user, 'topics' => $topics, 'files' => $files]);
    }

    public function showFiles($code){

        $course = Course::where('code', $code)
            ->first();

        $user = User::find(auth()->user()->id);
        $files = Course::getCourseFiles($course->id);

        return view('courses.course_files', ['course' => $course, 'user' => $user, 'files' => $files]);
    }
}
