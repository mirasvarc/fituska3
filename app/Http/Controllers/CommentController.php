<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
use App\HasSeenPost;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $comments = Comment::where('post_id', $post_id)->get();
        $comments_data = [];

        foreach($comments as $comment){
            $author = User::find($comment->author_id);
            $author_name = $author->name;
            $replies = $this->replies($comment->id);
            $reply = 0;
            $vote = 0;

            if(sizeof($replies) > 0){
                $reply = 1;
            }

            array_push($comments_data, [
                "author" => $author_name,
                "comment_id" => $comment->id,
                "content" => $comment->content,
                "reply" => $reply,
                "replies" => $replies,
                "date" => $comment->created_at->toDateTimeString()

            ]);
        }

        $comments_collection = collect($comments_data);
        return $comments_collection;
    }

    protected function replies($comment_id)
    {
        $comments = Comment::where('parent_id', $comment_id)->get();
        $replies = [];

        foreach($comments as $comment){
            $author = User::find($comment->author_id);
            $author_name = $author->name;
            $replies = $this->replies($comment->id);
            $reply = 0;
            $vote = 0;

            if(sizeof($replies) > 0){
                $reply = 1;
            }

            array_push($replies, [
                "author" => $author_name,
                "comment_id" => $comment->id,
                "content" => $comment->content,
                "reply" => $reply,
                "replies" => $replies,
                "date" => $comment->created_at->toDateTimeString()

            ]);
        }

        $comments_collection = collect($replies);
        return $comments_collection;
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

        $content = $request->content;

        // match all LaTex equations
        preg_match_all("/\[{2}([^\]]*)\]{2}/", $content, $matches);

        if($matches[1]) {
            foreach($matches[1] as $eq){
                // send request to online LaTex converter
                $response = file_get_contents('http://www.sciweavers.org/tex2img.php?eq='.trim($eq).'&fc=Black&im=png&fs=25&edit=0');
                $file = 'storage/uploads/latex/'.time().'.png';
                // save response as png
                file_put_contents($file, $response);
                // replace text equation with response image
                $content = preg_replace("/\[{2}([^\]]*)\]{2}/", '<img src="/'.$file.'">', $content, 1);
            }
        }

        $comment = new Comment;
        $comment->post_id = $request->post_id;
        $comment->author_id = $request->author_id;
        $comment->content = $content;

        if($request->parent_id){
            $comment->parent_id = $request->parent_id;
        }

        $comment->upvotes = 0;
        $comment->downvotes = 0;

        $comment->save();

        $hasSeenEntries = HasSeenPost::where('post_id', $request->post_id)->where('user_id', '!=', $request->author_id)->get();
        foreach($hasSeenEntries as $entry) {
            $toDelete = HasSeenPost::find($entry->id);
            $toDelete->delete();
        }

        return Response($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
