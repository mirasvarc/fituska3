<?php

namespace App\Http\Controllers;

use App\Modules;
use App\Role;
use App\Vote;
use App\UserHasVoted;
use App\HasRole;
use App\User;
use App\Facebook;
use App\Topics;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPanelController extends Controller
{

    public function index(){
        return view('admin.index');
    }

    public function modulesIndex(){

        $modules = Modules::get();

        return view('admin.modules', ['modules' => $modules]);
    }

    public function installModule(Request $request){
        $module = Modules::find($request->module_id);
        $module->installed = 1;
        $module->save();
        return redirect()->back();
    }

    public function uninstallModule(Request $request){
        $module = Modules::find($request->module_id);
        $module->installed = 0;
        $module->save();
        return redirect()->back();
    }

    public function voteIndex(){
        $all_votes = count(Vote::All()) != 0 ? Vote::All() : null;
        $users = User::All()->pluck('username', 'id')->toArray();

        return view('admin.vote', ['all_votes' => $all_votes,  'users' => $users]);
    }

    public function voteYes(){

        $vote = Vote::find($_REQUEST['vote_id']);
        $vote->vote_yes = $_REQUEST['vote_yes'];
        $vote->save();

        $userVoted = new UserHasVoted();
        $userVoted->user_id = Auth()->user()->id;
        $userVoted->vote_id = $vote->id;
        $userVoted->vote = "yes";
        $userVoted->save();

        $this->checkVotes($vote);

        return redirect()->back();
    }

    public function voteNo(){

        $vote = Vote::find($_REQUEST['vote_id']);
        $vote->vote_no = $_REQUEST['vote_no'];
        $vote->save();

        $userVoted = new UserHasVoted();
        $userVoted->user_id = Auth()->user()->id;
        $userVoted->user_voted = $vote->user_id;
        $userVoted->vote = "no";
        $userVoted->save();

        $this->checkVotes($vote);

        return redirect()->back();
    }

    private function checkVotes($vote){

        if($vote->vote_yes > 9 && $vote->vote_no < 3){

            $new_role = new HasRole();
            $new_role->user_id = $vote->user_id;
            $new_role->role_id = $vote->role_new;
            $new_role->save();

            $vote->delete();
        }

    }

    public function createVote(Request $request){

        $user = User::find($request->users);

        $role_teacher = Role::where('role', 'Učitel')->first();
        $role_doctoral = Role::where('role', 'Doktorand')->first();

        $role_teacher_approved = Role::where('role', 'Ověřený učitel')->first();
        $role_doctoral_approved = Role::where('role', 'Ověřený doktorand')->first();

        if($user->isTeacher()){
            $vote = new Vote();
            $vote->user_id = $user->id;
            $vote->role_current = $role_teacher->id;
            $vote->role_new = $role_teacher_approved->id;
            $vote->vote_yes = 0;
            $vote->vote_no = 0;
            $vote->save();
        } elseif( $user->isDoctoral()) {
            $vote = new Vote();
            $vote->user_id = $user->id;
            $vote->role_current = $role_doctoral->id;
            $vote->role_new = $role_doctoral_approved->id;
            $vote->vote_yes = 0;
            $vote->vote_no = 0;
            $vote->save();
        } else {
            return redirect('/admin/vote?createVoteErr');
        }

        return redirect('/admin/vote');

    }


    public function test(){

        $topic = Topics::where('name', 'Discord')->first();
        dd($topic);
/*
        $url = 'https://knot.fit.vutbr.cz/knotis/exportVO.php';
        $data = array('xs8iKIXhJ0Ut65Q7BTvvu2uFC5d31C');

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        dd($response);*/
    }

}
