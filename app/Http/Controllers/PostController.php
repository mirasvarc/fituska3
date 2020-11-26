<?php

namespace App\Http\Controllers;

use App\Post;
use App\Course;
use App\HasSeenPost;
use App\User;
use App\File;
use App\HasFile;

use Illuminate\Http\Request;

class PostController extends Controller
{

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

        // find course
        $course = Course::where('code', $request->code)->first();

        // create new post and save it to DB
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->type = $request->type;
        $post->course_id = $course->id;
        $post->author_id = auth()->user()->id;
        $post->upvotes = 0;
        $post->downvotes = 0;

        $post->save();

        // check for files in request
        foreach($request->file('files') as $file){

            // upload files and store path to DB
            $file->storeAs('public/files/'.$course->code.'/', $file->getClientOriginalName());
            $new_file = new File;
            $new_file->name = isset($file->name) ? $file->name : $file->getClientOriginalName(); // TODO: user can specify name if file (not path)
            $new_file->type = $file->getClientOriginalExtension();
            $new_file->path = $file->getClientOriginalName();
            $new_file->save();

            $has_file = new HasFile;
            $has_file->post_id = $post->id;
            $has_file->file_id = $new_file->id;
            $has_file->save();
        }

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
        $post = Post::where('id', $id)->first(); // get post
        $course = Course::where('id', $post->course_id)->first(); // find course which the post belongs to
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

        return view('posts/post', ['post' => $post, 'course' => $course, 'content_json' => $post_content->toJson(), 'comments' => $comments, 'user' => $user]);
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
     * //TODO
     */
    public function followCourse(){

    }

    public function openPost(Request $request){

        $post = Post::find($request['id']);

        if(!HasSeenPost::where('user_id', auth()->user()->id)->where('post_id', $post->id)->exists()){
            $hasSeenPost = new HasSeenPost();
            $hasSeenPost->user_id = auth()->user()->id;
            $hasSeenPost->post_id = $post->id;
            $hasSeenPost->save();
        }


    }
}
