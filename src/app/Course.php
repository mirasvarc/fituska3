<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\IsFollowingCourse;
class Course extends Model
{

    /**
     * get all courses from db
     */
    public static function getAllCourses(){
        return Course::all();
    }

    /**
     * get course by ID
     * @param id course id
     */
    public static function getCourse($id){
        return Course::find($id);
    }

    /**
     * get followed courses for specified user
     * @param user_id user id
     */
    public static function getFollowedCourses($user_id) {
        return User::find($user_id)->followedCourses()->get();
    }
}
