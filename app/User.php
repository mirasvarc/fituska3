<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\HasRole;
use App\Role;

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


    public function userSettings(){
        return $this->hasOne('App\UserSettings');
    }

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'has_role', 'user_id', 'role_id');
    }


    public function hasSeenPost()
    {
        return $this->belongsToMany('App\Post', 'has_seen_post', 'user_id', 'post_id');
    }

    public function isFollowingCalendar()
    {
        return $this->belongsToMany('App\Calendar', 'is_following_calendar', 'user_id', 'calendar_id');
    }

    /**
     * Check if current user is administrator
     */
    public function isAdministrator() {
        return $this->roles()->where('role', 'Administrátor')->exists();
    }

    /**
     * Check if current user is member of SU management
     */
    public function isSUManagement(){
        return $this->roles()->where('role', 'Vedení SU')->exists();
    }

    /**
     * Check if current user is moderator
     */
    public function isModerator(){
        return $this->roles()->where('role', 'Moderátor')->exists();
    }

    public function canModerate(){
        return $this->isAdministrator() || $this->isSUManagement() || $this->isModerator();
    }

    public function canSeeExams(){
        if($this->isAdministrator() ||
            $this->isSUManagement() ||
            $this->isModerator() ||
            $this->roles()->where('role', 'Ověřený učitel')->exists() ||
            $this->roles()->where('role', 'Ověřený doktorand')->exists() ||
            $this->roles()->where('role', 'Student')->exists()
        ) {
            return true;
        } else return false;
    }

    public function isTeacher(){
        return $this->roles()->where('role', 'Učitel')->exists();
    }

    public function isDoctoral(){
        return $this->roles()->where('role', 'Doktorand')->exists();
    }

    /**
     * Get courses followed by user
     */
    public function followedCourses(){
        return $this->belongsToMany('App\Course', 'is_following_course', 'user_id', 'course_id');
    }

    /**
     * check if user follow specified course
     * @param course_id course id
     */
    public function isFollowingCourse($course_id){
        return $this->followedCourses()->where('course_id', $course_id)->exists();
    }

    /**
     * Get all users
     */
    public static function getAllUsers(){
        return User::all();
    }

    /**
     * Get user by ID
     * @param id user id
     */
    public static function getUser($id){
        return User::find($id);
    }

    public static function isMoreThanOneAdmin(){

        $role = Role::where('role', 'Administrátor')->first();
        $admins = HasRole::where('role_id', $role->id)->get();

        return count($admins) > 1 ? true : false;
    }
}
