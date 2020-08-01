<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    public function author(){
        return $this->hasOne('App\User', 'id', 'author_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    public function isAuthor(){
        return $this->author()->first() == auth()->user();
    }
}
