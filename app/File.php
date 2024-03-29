<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'file';


    public function author(){
        return $this->hasOne('App\User', 'id', 'author_id');
    }
}
