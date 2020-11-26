<?php

namespace App\Http\Controllers;

use App\Modules;

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
}
