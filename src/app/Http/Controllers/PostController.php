<?php

namespace App\Http\Controllers;

use App\Post;
use App\Course;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $course = Course::where('code', $request->code)->first();

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->type = $request->type;
        $post->course_id = $course->id;
        $post->author_id = auth()->user()->id;
        $post->upvotes = 0;
        $post->downvotes = 0;

        $post->save();

        return redirect('/post/'.$request->code."/".$post->id)->with('success', 'Příspěvek byl úspěšně vytvořen!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code, $id)
    {
        $post = Post::where('id', $id)->first();
        $course = Course::where('id', $post->course_id)->first();
        $post_content = collect($post)->only('content');
        $comments = $post->comments()->get();

        return view('posts/post', ['post' => $post, 'course' => $course, 'content_json' => $post_content->toJson(), 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code, $id)
    {
        $post = Post::where('id', $id)->first();

        $subset = collect($post)->only('content');

        return view('posts/post_edit', ['post' => $post, 'code' => $code, 'post_content_json' => $subset->toJson()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->type = $request->type;

        $post->save();

        return redirect('/post/'.$request->code."/".$post->id)->with('success', 'Příspěvek byl úspěšně upraven!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        $course = Course::where('id', $post->course_id)->first();
        return redirect('/course/'.$course->code)->with('success', 'Příspěvek byl úspešně smazán!');
    }

    /**
     * TODO: All or just one year?
     */
    public function followCourse(){

    }
}
