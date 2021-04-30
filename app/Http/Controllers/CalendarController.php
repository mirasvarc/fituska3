<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;
use App\IsFollowingCalendar;

use function Symfony\Component\String\b;

class CalendarController extends Controller
{

    /**
     * Store calendar to database
     */
    public function storeCalendar(Request $request) {
        $calendar = new Calendar();
        $calendar->calendar_id = $request->calendar_id;
        $calendar->save();

        return "Calendar saved";
    }

    /**
     * Follow selected calendar
     */
    public function followCalendar(Request $request) {

        $calendar = Calendar::where('calendar_id', $request->calendar_id)->first();

        $following = new IsFollowingCalendar();
        $following->user_id = $request->user_id;
        $following->calendar_id = $calendar->id;
        $following->save();
        return true;
    }

    /**
     * Unfollow selected calendar
     */
    public function unfollowCalendar(Request $request) {
        $calendar = Calendar::where('calendar_id', $request->calendar_id)->first();
        $following = IsFollowingCalendar::where('calendar_id', $calendar->id)->where('user_id', $request->user_id)->first();
        $following->delete();
        return true;
    }
}
