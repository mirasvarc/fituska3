<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'modules';



    public function checkModule($module_name){

        $modules = Modules::all();

        foreach($modules as $module){
            if($module->name == $module_name){
                if($module->installed == 1){
                    return true;
                }
            }
        }
        return false;
    }
}
