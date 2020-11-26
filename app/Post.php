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

    /**
     * Files that belong to the post.
     */
    public function files()
    {
        return $this->belongsToMany('App\File', 'has_file', 'post_id', 'file_id');
    }

    /**
     * Check if user is author of the post
     */
    public function isAuthor(){
        return $this->author()->first() == auth()->user();
    }
}
