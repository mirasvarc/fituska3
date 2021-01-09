<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    /**
     * Get user by ID
     * @param id user id
     */
    public static function getRole($id){
        return Role::find($id);
    }
}
