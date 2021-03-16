<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserHasVoted;

class Vote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_vote';

    public function hasUserVoted($user_id, $vote_id){
        $user_voted = UserHasVoted::where('user_id', $user_id)->where('vote_id', $vote_id)->first();
        if($user_voted == null){
            return false;
        } else {
            return true;
        }
    }

}
