<?php

namespace App\Http\Controllers;

use App\Course;
use App\Post;
use App\User;
use App\Topics;
use App\File;
use App\HasFile;
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
        $courses = Course::All();

        $subset = $courses->map(function ($course) {
            return collect($course)
                ->only(['id', 'code', 'full_name', 'study_year', 'type'])
                ->all();
        });


        return view('courses/courses', ['courses' => $subset->toJson()]);
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

        return view('courses/course_show', ['course' => $course, 'user_settings' => $userSettings->user_settings_json, 'user' => $user, 'topics' => $topics, 'files' => $files, 'all_files' => $all_files]);
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
}
