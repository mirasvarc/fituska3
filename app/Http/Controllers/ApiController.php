<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Post;
use App\Topics;

class ApiController extends Controller
{
    public function getCoursePosts($code){
        $course = Course::where('code', $code)->first();
        if(!isset($course) || $course == null){
            return "ERR";
        }

        $topics = Topics::where('course_id', $course->id)->get();

        $topics_ids = [];
        foreach($topics as $topic){
            $topics_ids[] = $topic->id;
        }
        $posts = Post::whereIn('topic_id', $topics_ids)->take(5)->get();

        return $posts;
    }
}
