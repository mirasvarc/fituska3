<?php

namespace App\Http\Controllers;

use App\Topics;
use App\Post;
use App\Course;
use App\HasSeenPost;
use App\User;
use App\File;
use App\HasFile;
use App\Form;

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

    /**
     *  Send request to dc API
     */
    public function sendDCMultimsg(Request $request){

        $response = Http::post('http://127.0.0.1:5000/sendDCMsg', [
            'content' => "test",
            'channel' => (int)$request->channel,
            'author' => auth()->user()->username
        ]);

        return redirect()->back();
    }


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

    public function showSUContact(){
        return view('su.contact');
    }

    public function SUContactFormSave(Request $request) {
        $form = new Form();
        $form->full_name = $request->full_name;
        $form->email = $request->email;
        $form->msg = $request->msg;
        $form->save();

        return redirect('/su-contact?success');
    }

    public function showSUForms(){

        $forms = Form::all();

        return view('su.forms', ['forms' => $forms]);
    }

}
