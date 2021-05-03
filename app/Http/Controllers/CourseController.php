<?php

namespace App\Http\Controllers;

use App\Course;
use App\Post;
use App\User;
use App\Topics;
use App\File;
use App\HasFile;
use App\Calendar;
use App\Google;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Collection;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Course::orderBy('id', 'asc')->paginate(15);
        return view('courses/courses', compact('data'));
    }

    function fetch_data(Request $request) {
        if($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
                    $query = $request->get('query');
                    $query = str_replace(" ", "%", $query);
            $data = Course::where('id', 'like', '%'.$query.'%')
                            ->orWhere('code', 'like', '%'.$query.'%')
                            ->orWhere('full_name', 'like', '%'.$query.'%')
                            ->orderBy($sort_by, $sort_type)
                            ->paginate(15);

            return view('courses.courses_data', compact('data'))->render();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $course = Course::where('code', $code)
            ->first();

        $topics = Topics::where('course_id', $course->id)->get();

        $user = User::find(auth()->user()->id);

        $userSettings = $user->userSettings()->first();

        $files = Course::getCourseFiles($course->id);

        $all_files = $course->files()->get();

        $google = new Google();
        $calendar_events = $google->getEventsFromCalendar($course->calendar_id, $course->code);

        $shared_files = $google->getSharedFilesForCourse($course->code);

        $scriptum = $google->getStudentScriptumForCourse($course->code);


        return view(
            'courses/course_show',
            [
                'course' => $course,
                'user_settings' => $userSettings->user_settings_json,
                'user' => $user,
                'topics' => $topics,
                'files' => $files,
                'all_files' => $all_files,
                'calendar_events' => $calendar_events,
                'shared_files' => $shared_files,
                'scriptum' => $scriptum
            ]);
    }

    /**
     * show all uploaded files
     */
    public function showFiles($code){

        $course = Course::where('code', $code)
            ->first();

        $user = User::find(auth()->user()->id);
        $files = Course::getCourseFiles($course->id);

        return view('courses.course_files', ['course' => $course, 'user' => $user, 'files' => $files]);
    }

    /**
     * upload file to server
     */
    public function uploadFile(Request $request){

        $course = Course::find($request->course_id);

        if($request->file('files')){
            // check for files in request
            foreach($request->file('files') as $file){

                // upload files and store path to DB
                $file->storeAs('public/files/'.$course->code.'/', $file->getClientOriginalName());
                $new_file = new File;
                $new_file->author_id = auth()->user()->id;
                $new_file->name = isset($file->name) ? $file->name : $file->getClientOriginalName(); // TODO: user can specify name if file (not path)
                $new_file->type = $file->getClientOriginalExtension();
                $new_file->path = $file->getClientOriginalName();
                $new_file->is_exam = 0;
                $new_file->save();

                $has_file = new HasFile;
                $has_file->post_id = null;
                $has_file->course_id = $course->id;
                $has_file->file_id = $new_file->id;
                $has_file->save();
            }
        }

        return redirect()->back();
    }

    /**
     * upload exam file to server
     */
    public function uploadExam(Request $request){

        $course = Course::find($request->course_id);

        if($request->file('files')){
            // check for files in request
            foreach($request->file('files') as $file){

                // upload files and store path to DB
                $file->storeAs('public/files/'.$course->code.'/', $file->getClientOriginalName());
                $new_file = new File;
                $new_file->author_id = auth()->user()->id;
                $new_file->name = isset($file->name) ? $file->name : $file->getClientOriginalName(); // TODO: user can specify name if file (not path)
                $new_file->type = $file->getClientOriginalExtension();
                $new_file->path = $file->getClientOriginalName();
                $new_file->is_exam = 1;
                $new_file->save();

                $has_file = new HasFile;
                $has_file->post_id = null;
                $has_file->course_id = $course->id;
                $has_file->file_id = $new_file->id;
                $has_file->save();
            }
        }

        return redirect()->back();
    }

    /**
     * get courses from faculty website and import them to database
     */
    public function importCourses() {

        $google = new Google();

        // get html from courses page
        $html = file_get_contents('https://www.fit.vut.cz/study/courses/.cs');

        // get only table wotch courses
        $start = stripos($html, '<tbody');
        $end = stripos($html, '</tbody>', $offset = $start);
        $length = $end - $start;
        $htmlSection = substr($html, $start, $length);

        // get rows of table
        preg_match_all('@<tr>(.+)</tr>@', $htmlSection, $matches);
        $listItems = $matches[1];

        $courses = [];

        foreach ($listItems as $key => $item) {
            // get course name
            preg_match_all('@/.cs">(.+)</a>@', $item, $matchesName);

            // get course code
            preg_match_all('@</a></td><td>(.+)</td><td>[LZ]<@', $item, $matchesCode);

            // make array with courses
            if(!in_array(['code' => $matchesCode[1][0], 'name' => $matchesName[1][0]], $courses)){
                $courses[] = ['code' => $matchesCode[1][0], 'name' => $matchesName[1][0]];
            }
        }

        foreach($courses as $c) {

            if($c['code'] != "" && $c['name'] != "") {
                $old_course = Course::where('code', $c['code'])->first();
                if($old_course == null) { // check if course already exist
                    $course = new Course();
                    $course->code = $c['code'];
                    $course->full_name = $c['name'];
                    $course->calendar_id = $google->createCalendarForCourse($c['code']);
                    $course->save();
                    echo "Course ".$c['code']." imported.\n";
                }
            }
        }
    }

    /**
     * Check if every course has own google calendar. If not, create one.
     */
    public function updateGoogleCalendars() {
        $courses = Course::get();
        $google = new Google();

        foreach($courses as $course) {
            if($course->calendar_id == null)  {
                $course->calendar_id = $google->createCalendarForCourse($course->code);
                $course->save();
                echo "Calendar for ".$course->code. "loaded\n";
                return $course;
                //sleep(300);
            }
        }

        echo "Calendars updated.";
    }




    public function createSharedFile(Request $request) {

        $google = new Google();
        $file = $google->createSharedFile($request->file_course_code, $request->shared_file_name);

        return redirect()->back();
    }

    /**
     * Check if course has id of Google calendar stored
     */
    public function updateCourseCalendar(Request $request) {
        $course = Course::where('code', $request->code)->first();
        $course->calendar_id = $request->calendar_id;
        $course->save();
        return true;
    }
}
