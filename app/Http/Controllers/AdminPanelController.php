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

    /**
     * Show Admin panel
     */
    public function index(){
        return view('admin.index');
    }

    /**
     * Show module panel
     */
    public function modulesIndex(){

        $modules = Modules::get();

        return view('admin.modules', ['modules' => $modules]);
    }

    /**
     * Install selected module
     * @param Request
     */
    public function installModule(Request $request){
        $module = Modules::find($request->module_id);
        $module->installed = 1;
        $module->save();
        return redirect()->back();
    }

    /**
     * Unninstall selected module
     * @param Request
     */
    public function uninstallModule(Request $request){
        $module = Modules::find($request->module_id);
        $module->installed = 0;
        $module->save();
        return redirect()->back();
    }

    /**
     * Show user voting
     */
    public function voteIndex(){
        $all_votes = count(Vote::All()) != 0 ? Vote::All() : null;
        $users = User::All()->pluck('username', 'id')->toArray();

        if($all_votes != null){
            foreach($all_votes as $vote) {
                date_default_timezone_set('Europe/Prague');
                $date1 = new \DateTime(date("Y-m-d H:i:s"));
                $date2 = new \DateTime($vote->created_at->toDateTimeString());
                $interval = date_diff($date1, $date2);
    
                if($interval->days > 14) {
                    if($vote->vote_yes > 2 && $vote->vote_no == 0){
                    
                        $new_role = new HasRole();
                        $new_role->user_id = $vote->user_id;
                        $new_role->role_id = $vote->role_new;
                        $new_role->save();
            
                        $vote->delete();

                        return redirect('/admin/vote');
                    }
                }
            }
        
        }

        return view('admin.vote', ['all_votes' => $all_votes,  'users' => $users]);
    }

    /**
     * Vote Yes
     */
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

    /**
     * Vote No
     */
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

    /**
     * Check number of votes and proceed role change
     */
    private function checkVotes($vote){

        if($vote->vote_yes == count(HasRole::where('role_id', 3)->get()) && $vote->vote_no == 0){

            $new_role = new HasRole();
            $new_role->user_id = $vote->user_id;
            $new_role->role_id = $vote->role_new;
            $new_role->save();

            $vote->delete();
        }

    }

    /**
     * Create new vote for selected user
     */
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


    /**
     * Function for testing purposes
     */
    public function test(){

       // dd(file_get_contents('http://knot.fit.vutbr.cz/knotis/exportVO.php'));

        $url = 'http://knot.fit.vutbr.cz/knotis/exportVO.php';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, 'xs8iKIXhJ0Ut65Q7BTvvu2uFC5d31C');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        dd($response);
    }

}
