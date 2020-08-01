<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'school_mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'has_role', 'user_id', 'role_id');
    }

    public function isAdministrator() {
        return $this->roles()->where('role', 'Administrátor')->exists();
    }

    public function isSUManagement(){
        return $this->roles()->where('role', 'Vedení SU')->exists();
    }

    public function followedCourses(){
        return $this->belongsToMany('App\Course', 'is_following_course', 'user_id', 'course_id');
    }

    public function isFollowingCourse($course_id){
        return $this->followedCourses()->where('course_id', $course_id)->exists();
    }
}
