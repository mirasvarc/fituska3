<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Post;
use App\Topics;

class ApiController extends Controller
{

    /**
     * Return posts for given course
     */
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
        $posts = Post::whereIn('topic_id', $topics_ids)->limit(10)->orderBy('created_at', 'desc')->get();

        return $posts;
    }


    /**
     * Store post from Discord to database
     */
    public function addPostFromDiscord(Request $request) {

        $course = Course::where('code', trim($request->course, "[]"))->first();
        $topic = Topics::where('course_id', $course->id)->where('name', 'Discord')->first();

        if($topic == null) {
            $topic = new Topics();
            $topic->name = "Discord";
            $topic->course_id =$course->id;
            $topic->save();
        }

        $post = new Post();
        $post->author_id = 6;
        $post->topic_id = $topic->id;
        $post->course_id = $course->id;
        $post->title = "Discord post";
        $post->content = $request->content;
        $post->downvotes = 0;
        $post->upvotes = 0;
        $post->type = 'Diskuze';
        $post->save();
        return true;
    }
}
