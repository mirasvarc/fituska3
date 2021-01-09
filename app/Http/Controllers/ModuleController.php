<?php

namespace App\Http\Controllers;

use App\Topics;
use App\Post;
use App\Course;
use App\HasSeenPost;
use App\User;
use App\File;
use App\HasFile;

use Illuminate\Http\Request;

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




}
