<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\hasRole;
use App\IsFollowingCourse;
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
        $user = User::find($id);
        $userSettings = User::find($id)->userSettings()->first();
        //dd($userSettings);
        $roles_user_have = $user->roles->pluck('role', 'id')->toArray();
        $all_roles = Role::All()->pluck('role', 'id')->toArray();

        $roles_user_dont_have = array_diff($all_roles, $roles_user_have);

        $roles_string = '';
        $comma = '';

        foreach($roles_user_have as $role){
            $roles_string = $roles_string.$comma.$role;
            $comma = ', ';
        }

        return view('user.profile', ['user' => User::findOrFail($id), 'roles_string' => $roles_string, 'roles_have' => $roles_user_have, 'roles_dont_have' => $roles_user_dont_have]);
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
        $user = User::find($id);

        $user->delete();
        return redirect('/')->with('success', 'Uživatel byl úspešně smazán!');
    }

    /**
     * Add role to user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addRole(Request $request){
        $hasRole = new hasRole();
        $hasRole->user_id = $request->input('user');
        $hasRole->role_id = $request->input('roles');
        $hasRole->save();
        return redirect()->back()->with('success', 'Role byla úspešně přidána!');
    }

    /**
     * Remove role from user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    public function followCourse(Request $request){
        $followedCourse = new IsFollowingCourse();
        $followedCourse->user_id = $request->input('user');
        $followedCourse->course_id = $request->input('course');
        $followedCourse->save();
        return redirect()->back()->with('success', 'Předmět je sledován!');
    }

    public function unfollowCourse(Request $request){
        $user_id = $request->input('user');
        $course_id = $request->input('course');
        $db_record = IsFollowingCourse::where('user_id', $user_id)
                        ->where('course_id', $course_id)
                        ->first()
                        ->delete();
        return redirect()->back()->with('success', 'Předmět odebrán ze sledovaných!');

    }
}
