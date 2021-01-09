<?php

namespace App\Http\Controllers;

use App\Modules;

use App\Vote;

use Illuminate\Http\Request;
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

        return view('admin.vote', ['all_votes' => $all_votes]);
    }

    public function voteYes(){

        $vote = Vote::find($_REQUEST['vote_id']);
        $vote->vote_yes = $_REQUEST['vote_yes'];
        $vote->save();

        return redirect()->back();
    }

    public function voteNo(){

        $vote = Vote::find($_REQUEST['vote_id']);
        $vote->vote_no = $_REQUEST['vote_no'];
        $vote->save();

        return redirect()->back();
    }

    private function checkVotes(){


    }

}
