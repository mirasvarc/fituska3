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

        // $users = DB::table('has_role')
        // ->join('roles', 'roles.id', '=', 'has_role.role_id')
        // ->join('users', 'users.id', '=', 'has_role.user_id')
        // ->select('*')
        // ->get();
        // dd($users);
        $users = DB::table('users')->get();
        return view('users', ['users' => $users]);
    }

   }
