<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Modules;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::getAllCourses();
        $followed_courses = Course::getFollowedCourses(auth()->user()->id);
        $modules = Modules::get();

        return view('home', ['courses' => $courses, 'followed_courses' => $followed_courses, 'modules' => $modules]);
    }
}
