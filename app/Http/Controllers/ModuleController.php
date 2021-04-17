<?php

namespace App\Http\Controllers;

use App\Topics;
use App\Post;
use App\Comment;
use App\Course;
use App\HasSeenPost;
use App\User;
use App\File;
use App\HasFile;
use App\Form;
use App\Facebook;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ModuleController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMultiMsg()
    {

        return view('modules/multiMsg');
    }


    /**
     *  Send request to facebook API
     */
    public function sendFbMultimsg(Request $request){
        dd($request);
        // TODO: FB Api
    }

    public function getFacebookPosts(Request $request) {
        $group_id = "1722428574572165"; // TODO: from request
        $facebook = new Facebook();
        $posts_raw = $facebook->getPostsFromGroup($group_id);

        $posts = [];
        foreach($posts_raw['data'] as $post_data) {

            if(isset($post_data['comments'])) {
                $post = $facebook->parsePost($post_data['id'], $post_data['message'], $post_data['comments']['data']);
            } else {
                $post = $facebook->parsePost($post_data['id'], $post_data['message']);
            }

            if($post) {
                $posts[] = $post;
            }

        }

        $this->storeFacebookPosts($posts);
    }

    public function storeFacebookPosts($posts) {

        $topic = Topics::where('name', 'Facebook')->first();


        foreach($posts as $post) {

            $course = Course::where('code', $post['course_code'])->first();
            if($post['author'] == null) {
                $author = User::where('username', 'FITuška')->first();
            }

            if(Post::where('facebook_post_id', $post['id'])->first() == null) {

                $new_post = new Post();
                $new_post->facebook_post_id = $post['id'];
                $new_post->author_id = $author->id;
                $new_post->topic_id = $topic->id;
                $new_post->course_id = $course->id;
                $new_post->title = 'Facebook post';
                $new_post->content = '<p>' . $post['content'] . '</p>';
                $new_post->upvotes = 0;
                $new_post->downvotes = 0;
                $new_post->type = 'Diskuze';
                $new_post->save();

                if(isset($post['comments'])){

                    foreach($post['comments'] as $fb_comment) {
                        $comment = new Comment();
                        $comment->author_id = $author->id;
                        $comment->post_id = $new_post->id;
                        $comment->content = $fb_comment['message'];
                        $comment->upvotes = 0;
                        $comment->downvotes = 0;
                        $comment->save();
                    }
                }

                echo "post ".$post['id']." imported! ";
            } else {
                echo "post ".$post['id']." already imported! ";
            }


        }

        echo "import successful! ";
    }

    /**
     *  Send message to discord
     */
    public function sendDCMultimsg(Request $request){

        $response = Http::post('http://127.0.0.1:5000/sendDCMsg', [
            'content' => "test",
            'channel' => (int)$request->channel,
            'author' => auth()->user()->username
        ]);

        return redirect()->back();
    }


    /**
     * Show all members of SU
     */
    public function showSUMembers(){

        $su_management = User::whereHas(
            'roles', function($q){
                $q->where('role', 'Vedení SU');
            }
        )->get();

        $su = User::whereHas(
            'roles', function($q){
                $q->where('role', 'Člen SU');
            }
        )->get();


        return view('su.members', ['su' => $su, 'su_management' => $su_management]);

    }

    /**
     * Show page with SU contact form
     */
    public function showSUContact(){
        return view('su.contact');
    }


    /**
     * Save contact form to db
     */
    public function SUContactFormSave(Request $request) {
        $form = new Form();
        $form->full_name = $request->full_name;
        $form->email = $request->email;
        $form->msg = $request->msg;
        $form->save();

        return redirect('/su-contact?success');
    }

    /**
     * show all submited forms
     */
    public function showSUForms(){

        $forms = Form::all();

        return view('su.forms', ['forms' => $forms]);
    }



     /**
     * upload file to server
     */
    public function uploadFile(Request $request){

        if($request->file('files')){
            // check for files in request
            foreach($request->file('files') as $file){

                // upload files and store path to DB
                $file->storeAs('public/files/su/', $file->getClientOriginalName());
                $new_file = new File;
                $new_file->author_id = auth()->user()->id;
                $new_file->name = isset($file->name) ? $file->name : $file->getClientOriginalName(); // TODO: user can specify name if file (not path)
                $new_file->type = $file->getClientOriginalExtension();
                $new_file->path = $file->getClientOriginalName();
                $new_file->is_exam = 0;
                $new_file->is_su = 1;
                if($request->su_private == 'on') {
                    $new_file->is_su_private = 1;
                }
                $new_file->save();
            }
        }

        return redirect()->back();
    }


     /**
     * upload file to server
     */
    public function showSUFiles(){

        $su_files = File::where('is_su', 1)->where('is_su_private', null)->get();
        $su_files_private = File::where('is_su', 1)->where('is_su_private', 1)->get();

        return view('su.file_storage', ['su_files' => $su_files, 'su_files_private' => $su_files_private]);
    }

}
