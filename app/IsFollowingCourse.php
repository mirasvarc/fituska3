<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IsFollowingCourse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'is_following_course';

    public $foreignKey = 'user_id';
}
