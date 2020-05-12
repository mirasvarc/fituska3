<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class AdminPanelController extends Controller
{
    /**
     * Display all users
     *
     * @return \Illuminate\Http\Response
     */
    public function all_users()
    {

        $users = DB::table('users')->get();

        return view('users', ['users' => $users]);
    }

   }
