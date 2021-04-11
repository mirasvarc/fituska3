<?php

namespace App\Http\Controllers;

use App\Post;
use App\Course;
use App\HasSeenPost;
use App\User;
use App\File;
use App\HasFile;
use App\Topics;
use App\UserVotedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($code, $topic_id)
    {
        return view('posts/post_create', ['code' => $code, 'topic_id' => $topic_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forumCreate($topic_id)
    {
        return view('posts/post_create', ['topic_id' => $topic_id, 'isForum' => 1]);
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
        ]);

        // find topic
        $topic = Topics::where('id', $request->topic_id)->first();

        // create new post and save it to DB
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->type = $request->type;
        $post->topic_id = $topic->id;

        if(!isset($request->isforum)){
            // find course
            $course = Course::where('code', $request->code)->first();
            $post->course_id = $course->id;
        }

        $post->author_id = auth()->user()->id;
        $post->upvotes = 0;
        $post->downvotes = 0;

        $post->save();

        if(!isset($request->isforum)){
            if($request->file('files')){
                // check for files in request
                foreach($request->file('files') as $file){

                    // upload files and store path to DB
                    $file->storeAs('public/files/'.$course->code.'/', $file->getClientOriginalName());
                    $new_file = new File;
                    $new_file->author_id = auth()->user()->id;
                    $new_file->name = isset($file->name) ? $file->name : $file->getClientOriginalName(); // TODO: user can specify name if file (not path)
                    $new_file->type = $file->getClientOriginalExtension();
                    $new_file->path = $file->getClientOriginalName();
                    $new_file->save();

                    $has_file = new HasFile;
                    $has_file->post_id = $post->id;
                    $has_file->course_id = $course->id;
                    $has_file->file_id = $new_file->id;
                    $has_file->save();
                }
            }
        }

        if(!isset($request->isforum)){
            $response = Http::post('http://127.0.0.1:5000/send', [
                'course' => $course->code,
                'post'  => $post,
                'author' => auth()->user()->username
            ]);
        }

        if(!isset($request->isforum)){
            return redirect('/post/'.$request->code."/".$post->id)->with('success', 'Příspěvek byl úspěšně vytvořen!');
        } else {
            return redirect('/forum/topic/'.$topic->id.'/post/'.$post->id)->with('success', 'Příspěvek byl úspěšně vytvořen!');
        }
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
        $topic = Topics::where('id', $post->topic_id)->first();
        $course = Course::where('id', $topic->course_id)->first(); // find course which the post belongs to

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

        $userVotePost = UserVotedPost::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        //dd($userVotePost);

        return view('posts/post', [
            'post' => $post,
            'course' => $course,
            'content_json' => $post_content->toJson(),
            'comments' => $comments,
            'user' => $user,
            'topic' => $topic,
            'user_vote' => $userVotePost
            ]);
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
        $topic = Topics::where('id', $post->topic_id)->first();
        $course = Course::where('id', $post->course_id)->first();
        return redirect('/course/'.$course->code.'/topic/'.$topic->id)->with('success', 'Příspěvek byl úspešně smazán!');
    }

    /**
     * Mark post as seen
     * @param  \Illuminate\Http\Request  $request
     */
    public function openPost(Request $request){

        $post = Post::find($request['id']);

        if(!HasSeenPost::where('user_id', auth()->user()->id)->where('post_id', $post->id)->exists()){
            $hasSeenPost = new HasSeenPost();
            $hasSeenPost->user_id = auth()->user()->id;
            $hasSeenPost->post_id = $post->id;
            $hasSeenPost->save();
        }


    }

    /**
     * add upvote to post
     * @param request post
     * @return int number of upvotes
     */
    public function postUpvote(Request $request) {
        $post = Post::find($request->post_id);
        $post->upvotes = $post->upvotes + 1;
        $post->save();

        $userVoted = new UserVotedPost();
        $userVoted->user_id = auth()->user()->id;
        $userVoted->post_id = $post->id;
        $userVoted->vote_value = 1;
        $userVoted->save();

        return $post->upvotes;
    }

    /**
     * add downvote to post
     * @param request post
     * @return int number of downvotes
     */
    public function postDownvote(Request $request) {
        $post = Post::find($request->post_id);
        $post->downvotes = $post->downvotes + 1;
        $post->save();

        $userVoted = new UserVotedPost();
        $userVoted->user_id = auth()->user()->id;
        $userVoted->post_id = $post->id;
        $userVoted->vote_value = 0;
        $userVoted->save();

        return $post->downvotes;
    }
}
