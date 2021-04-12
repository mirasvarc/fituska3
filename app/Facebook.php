<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{

    private $ACCESS_TOKEN = 'EAAFAk2jZCpycBAK5rtDk9XjnUcAWDxtZAyDwjpRRK3h8XajTgcJq6kk1NhJr9yXmZAZA5ZAImhsVHAIsBHmCRdll2QaJPZC1ZA5sUunkewahGKTFfjWdqj1Epvm9zRZCxkOytDghOJ94BYA5YmnXKDHZAWMXMVmaH7FWX9uYexS0iCzO8otGpZAoZAbSN9NteznzL4ZD';

    /**
     * Get all posts from given facebook group
     * @param group_id facebook group id
     * @return json posts and comments from group
     */
    public function getPostsFromGroup($group_id) {
        return json_decode(file_get_contents('https://graph.facebook.com/'.$group_id.'/feed?fields=message,comments&access_token='.$this->ACCESS_TOKEN), true);
    }

    /**
     * Post to given facebook group
     * @param group_id facebook group id
     * @param data post content
     */
    public function postToGroup($group_id, $data) {
        // TODO: can't be done without submitting app for review (currently stopped by facebook due covid-19)
    }


    /**
     * Parse post from facebook group
     * @param message content of post
     * @param comments post comments
     * @param author author of the post
     * @return array return false when course tag is not present, otherwise return array with course code, content, comments and author of the post
     */
    public function parsePost($id, $message, $comments = null, $author = null) {

        // get course code from post
        preg_match('/(?<=\[).+?(?=\])/', $message, $course_code);

        // if there is no course code tag, skip post
        if(!$course_code) return false;

        // get post content
        $content = str_replace("[".$course_code[0]."]", "", $message);
        $response = ['course_code' => $course_code[0], 'id' => $id, 'content' => $content, 'comments' => $comments, 'author' => $author];

        return $response;
    }

}
