<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use DB;
class SearchController extends Controller
{


    public function search(Request $request) {
        if($request->ajax()) {
            $output = "";
            $posts = DB::table('posts')->where('title','LIKE','%'.$request->search."%")->orderBy('created_at', 'DESC')->get();
            $courses = DB::table('courses')->where('code','LIKE','%'.$request->search."%")->get();

            if($request->search != "") {
                if($posts) {
                    foreach ($posts as $key => $post) {
                        $date = date_create($post->created_at);
                        $topic = DB::table('topics')->where('id', $post->topic_id)->first();
                        $course = DB::table('courses')->where('id', $topic->course_id)->first();

                        $output .= '<a href=/post/'.$course->code.'/'.$post->id.'><div class="search-result"><span>'
                            .'['.$course->code.'] '.$post->title.
                            '</span><span>'. date_format($date, 'd.m.Y') .'</span></div></a>';
                    }

                }

                if($courses) {
                    foreach ($courses as $course) {
                        $posts = Post::where('course_id', $course->id)->orderBy('created_at', 'DESC')->get();
                        foreach ($posts as $key => $post) {
                            $date = date_create($post->created_at);
                            $output .= '<a href=/post/'.$course->code.'/'.$post->id.'><div class="search-result"><span>'
                            .'['.$course->code.'] '.$post->title.
                            '</span><span>'. date_format($date, 'd.m.Y') .'</span></div></a>';
                        }
                    }
                }

                return Response($output);

            }
        }
    }
}
