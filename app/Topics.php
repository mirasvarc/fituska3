<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'topics';

    public function posts(){
        return $this->hasMany('App\Post', 'topic_id', 'id');
    }
}
