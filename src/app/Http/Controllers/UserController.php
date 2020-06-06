<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\has_role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->get();
        return view('users', ['users' => $users]);
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
        $roles = DB::table('has_role')
            ->join('roles', 'roles.id', '=', 'has_role.role_id')
            ->join('users', 'users.id', '=', 'has_role.user_id')
            ->where('has_role.user_id', '=', $id)
            ->select('*')
            ->get();

        $roles_string = '';
        $comma = '';
        foreach($roles as $role){
            $roles_string = $roles_string.$comma.$role->role;
            $comma = ', ';
        }

        $roles = DB::table('roles')->get();
        $roles_array = $roles->pluck('role', 'id')->toArray();

        return view('user.profile', ['user' => User::findOrFail($id), 'roles_string' => $roles_string, 'roles' => $roles, 'roles_array' => $roles_array]);
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


    public function addRole(Request $request){
        $hasRole = new has_role();
        $hasRole->user_id = $request->input('user');
        $hasRole->role_id = $request->input('roles');
        $hasRole->save();
        return redirect()->back()->with('success', 'Role byla úspešně přidána!');
    }

    public function removeRole(Request $request){

        $user_id = $request->input('user');
        $role_id = $request->input('roles');
        $db_record = DB::table('has_role')
        ->where('user_id', '=', $user_id)
        ->where('role_id', '=', $role_id)
        ->select('*')
        ->delete();




        return redirect()->back()->with('success', 'Role byla úspešně odebrána!');
    }

}
