<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;
use App\Course;
use App\IsFollowingCalendar;
use App\Google;
use App\User;

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
     * Add new event to calendar
     */
    public function addNewEvent(Request $request) {

        if(isset($request->course)) {
            $course = Course::where('code', $request->course)->first();
            $calendar_id = $course->calendar_id;
        } else {
            $calendar_id = "primary";
        }

        $google = new Google();
        $google->addEvent($calendar_id, $request->event_name, $request->event_decs, $request->event_date);

        return redirect()->back();
    }

    /**
     * Follow selected calendar
     */
    public function followCalendar(Request $request) {
        $google = new Google();
        $client =  $google->getGoogleClient();
        $service = new \Google_Service_Calendar($client);

        $user = User::where('id', $request->user_id)->first();
        $course = Course::where('code', $request->course)->first();

        $google->shareCalendarWithUser($course->calendar_id, $user->mail, $service);

        $calendar = Calendar::where('calendar_id', $course->calendar_id)->first();

        if(!IsFollowingCalendar::where('user_id', $request->user_id)->where('calendar_id', $calendar->id)->first()) {
            $following = new IsFollowingCalendar();
            $following->user_id = $request->user_id;
            $following->calendar_id = $calendar->id;
            $following->save();
            return true;
        } else {
            return false;
        }

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

    /**
     * Check if calednar for given course exist. If not, create one.
     */
    public function checkIfCalendarExist(Request $request) {
        $course = Course::where('code', $request->course)->first();
        if($course->calendar_id == null) {
            $google = new Google();
            $google->createCalendarForCourse($course->code);
            return true;
        } else {
            return false;
        }

    }
}
