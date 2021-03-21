<?php

namespace App\Http\Controllers;

use App\Course;
use App\Forums;
use App\Post;
use App\Topics;
use App\User;
use App\HasSeenPost;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Topics::where('forum_id', 1)->get();
        return view('forum.index', ['forums' => $forums]);
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
    public function show($id)
    {
        $topic = Topics::where('id', $id)->first();
        $posts = Post::where('topic_id', $topic->id)->get();


        return view('forum.topics', ['posts' => $posts, 'topic' => $topic]);
    }

    public function showPost($id, $post_id) {
        $post = Post::where('id', $post_id)->first(); // get post
        $topic = Topics::where('id', $id)->first();
        $forum = Forums::where('id', $topic->forum_id)->first(); // find forum which the post belongs to

        $post_content = collect($post)->only('content'); // get content of all comments
        $comments = $post->comments()->get(); // get all comments

        $user = User::find(auth()->user()->id);


        // check if user has already seen the post
        if(!$user->hasSeenPost()->where('post_id', $post->id)->exists()){
            $hasSeenPost = new HasSeenPost();
            $hasSeenPost->user_id = $user->id;
            $hasSeenPost->post_id = $post->id;
            $hasSeenPost->save();
        }

        return view('forum.post', ['post' => $post, 'forum' => $forum, 'content_json' => $post_content->toJson(), 'comments' => $comments, 'user' => $user, 'topic' => $topic]);
    }

}
