<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;
use App\IsFollowingCourse;
class Course extends Model
{

  /**
     * Files that belong to the course.
     */
    public function files()
    {
        return $this->belongsToMany('App\File', 'has_file', 'course_id', 'file_id');
    }


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
     * @return courses followed by user
     */
    public static function getFollowedCourses($user_id) {
        return User::find($user_id)->followedCourses()->get();
    }

    /**
     * get all tpoics for given course
     * @param course_id course id
     */
    public static function getTopics($course_id){
        return Topics::where('course_id', $course_id)->get();
    }

    /**
     * get all posts for given topic
     * @param topic_id topic id
     */
    public static function getPosts($topic_id){
        return Post::where('topic_id', $topic_id)->get();
    }

    /**
     * get files from all posts for given course
     * @param course course id
     */
    public static function getCourseFiles($course_id){
        $topics = Course::getTopics($course_id);
        $files = [];
        foreach($topics as $topic){
            $posts = Course::getPosts($topic->id);
            foreach($posts as $post){
                if($post->files()->get()){
                    foreach($post->files()->get() as $file){
                        $files[] = $file;
                    }
                }

            }
        }


        return $files;
    }

}
