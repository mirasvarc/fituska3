<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class SearchController extends Controller
{


    public function search(Request $request) {
        if($request->ajax()) {
            $output = "";
            $posts = DB::table('posts')->where('title','LIKE','%'.$request->search."%")->get();
            //$courses = DB::table('courses')->where('code','LIKE','%'.$request->search."%")->get();

            if($request->search != "") {
                if($posts) {
                    foreach ($posts as $key => $post) {

                        $topic = DB::table('topics')->where('id', $post->topic_id)->first();
                        $course = DB::table('courses')->where('id', $topic->course_id)->first();

                        $output .= '<a href=/post/'.$course->code.'/'.$post->id.'><div class="search-result">'
                                    .'['.$course->code.'] '.$post->title.
                                    '</div></a>';
                    }
                    return Response($output);
                }

            }
        }
    }
}
