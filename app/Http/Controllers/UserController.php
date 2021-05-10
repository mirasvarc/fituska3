<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserSettings;
use App\Role;
use App\hasRole;
use App\IsFollowingCourse;
use App\UsersImport;
use Illuminate\Support\Facades\Hash;
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

        $roles_user_have = $user->roles->pluck('role', 'id')->toArray();
        $all_roles = Role::whereIn('id', [1, 3, 4, 9])->pluck('role', 'id')->toArray();

        $roles_user_dont_have = array_diff($all_roles, $roles_user_have);

        $roles_string = '';
        $comma = '';

        foreach($roles_user_have as $role){
            $roles_string = $roles_string.$comma.$role;
            $comma = ', ';
        }

        return view('user.profile', ['user' => User::findOrFail($id), 'roles_string' => $roles_string, 'roles_have' => $roles_user_have, 'roles_dont_have' => $roles_user_dont_have, 'user_settings' => $userSettings]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', ['user' =>$user]);
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
        $user = User::find($id);

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with('error','You have entered wrong password');

        } else {
            if(isset($request->new_password)){
                $user->password = bcrypt($request->new_password);
            }

            $user->username = $request->username;
            $user->first_name = $request->first_name ? $request->first_name : "";
            $user->surname = $request->surname ? $request->surname : "";
            $user->mail = $request->mail ? $request->mail : "";
            $user->about = $request->about ? $request->about : "";
            $user->save();

            return redirect('/user/' . $user->id);
        }
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

        if($user->isAdministrator()){
            if($user->isMoreThanOneAdmin()) {
                $user->delete();
                return redirect('/')->with('success', 'Uživatel byl úspešně smazán!');
            }
            else {
                return redirect('/user/'.$user->id.'?delErr');
            }
        }
    }

    /**
     * Add role to user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addRole(Request $request)
    {
        $hasRole = new hasRole();
        $hasRole->user_id = $request->input('user');
        $hasRole->role_id = $request->input('roles');

        $hasRole->save();

        return redirect('/user/'.$request->user);
    }

    /**
     * Remove role from user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeRole(Request $request)
    {
        $user_id = $request->input('user');
        $role_id = $request->input('roles');

        $role = Role::where('id', $role_id)->first();
        if($role->role == "Administrátor"){
            return redirect('/user/'.$user_id.'?err');
        }

        $db_record = DB::table('has_role')
                        ->where('user_id', '=', $user_id)
                        ->where('role_id', '=', $role_id)
                        ->select('*')
                        ->delete();

        return redirect('/user/'.$user_id);
    }

    /**
     * Follow course
     * @param Request
     */
    public function followCourse(Request $request)
    {
        $followedCourse = new IsFollowingCourse();
        $followedCourse->user_id = $request->input('user');
        $followedCourse->course_id = $request->input('course');
        $followedCourse->save();

        return redirect()->back()->with('success', 'Předmět je sledován!');
    }

    /**
     * Unfollow course
     * @param Request
     */
    public function unfollowCourse(Request $request)
    {
        $user_id = $request->input('user');
        $course_id = $request->input('course');
        $db_record = IsFollowingCourse::where('user_id', $user_id)
                        ->where('course_id', $course_id)
                        ->first()
                        ->delete();

        return redirect()->back()->with('success', 'Předmět odebrán ze sledovaných!');
    }

    /**
     * Change user settings
     * @param Request
     */
    public function changeSettings(Request $request){

        $userSettings = User::find($request->user)->userSettings()->first();
        $userSettingsJson = $userSettings->user_settings_json;
        if(isset($request->compact) && $request->compact == 'on'){
            $userSettingsJson['compact_mode'] = 'true';
            $userSettings->user_settings_json = $userSettingsJson;
        } else if(!isset($request->compact)) {
            $userSettingsJson['compact_mode'] = 'false';
            $userSettings->user_settings_json = $userSettingsJson;
        }

        $userSettings->save();

        return redirect()->back();
    }

    /**
     * Show contact page
     */
    public function contacts(){

        $su = User::whereHas(
            'roles', function($q){
                $q->where('role', 'Vedení SU');
            }
        )->get();

        $moderators = User::whereHas(
            'roles', function($q){
                $q->where('role', 'Moderátor');
            }
        )->get();

        $admins = User::whereHas(
            'roles', function($q){
                $q->where('role', 'Administrátor');
            }
        )->get();

        return view('contacts', ['su' => $su, 'moderators' => $moderators, 'admins' => $admins]);
    }

    /**
     * Show vote page
     */
    public function voteIndex() {
        return view('_partials.vote');
    }


    public function chooseAdmin(Request $request){


        $su = User::whereHas(
            'roles', function($q){
                $q->where('role', 'Vedení SU');
            }
        )->where('id', '<>', $request->curr_user)->inRandomOrder()->first();

        if($su == null){
            return redirect('/user/'.$request->curr_user.'?errChooseAdmin');
        }

        $role = Role::where('role', 'Administrátor')->first();

        $db_record = DB::table('has_role')
                        ->where('user_id', '=', $request->curr_user)
                        ->where('role_id', '=', $role->id)
                        ->select('*')
                        ->delete();


        $hasRole = new hasRole();
        $hasRole->user_id = $su->id;
        $hasRole->role_id = $role->id;

        $hasRole->save();

        if($request->del == 1){
            User::find($request->curr_user)->delete();
            return redirect('/');
        }

        return redirect('/user/'.$request->curr_user);
    }

    public function importUsers() {

        $url = 'http://knot.fit.vutbr.cz/knotis/exportVO.php';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'xs8iKIXhJ0Ut65Q7BTvvu2uFC5d31C');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $lines = explode("\n", $response);

        $users = [];

        foreach($lines as $line) {
            $users[] = explode(",", $line);
        }

        foreach($users as $user) {
            $imported = new UsersImport();
            $imported->login = isset($user[0]) ? $user[0] : null;
            $imported->name = isset($user[1]) ? $user[1] : null;
            $imported->surname = isset($user[2]) ? $user[2] : null;
            $imported->class = isset($user[3]) ? $user[3] : null;
            $imported->save();
        }

        return true;


    }
}
