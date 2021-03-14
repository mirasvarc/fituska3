<?php

namespace App\Http\Controllers;

use App\Course;
use App\Forums;
use App\Post;
use App\Topics;
use App\User;
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

}
