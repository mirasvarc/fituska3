@inject('modules', 'App\Modules')

@extends('layouts.app')

@section('content')
<div class="container-main">
    <div class="row justify-content-between">
        <div class="col-md-4">
            <div class="followed-courses">
                <div class="followed-courses-heading">
                    Sledované předměty
                </div>
                <div class="followed-courses-content">

                    <div class="row followed-courses-content-header">
                        <div class="col-2">
                            <span class="followed-courses-content-header-col">Zkratka</span>
                        </div>
                        <div class="col-6 text-center">
                            <span class="followed-courses-content-header-col">Název</span>
                        </div>
                        <div class="col-4 text-center">
                            <span class="followed-courses-content-header-col">Přestat sledovat</span>
                        </div>

                    </div>
                    @foreach($followed_courses as $followed_course)

                    <div class="row followed-courses-content-course">
                        <a href="/course/{{$followed_course->code}}" class="followed-courses-content-link col-8">
                            <div class="row">
                                <div class="col-4">
                                    {{$followed_course->code}}
                                </div>
                                <div class="col-7 text-center">
                                    <span>{{$followed_course->full_name}}</span>
                                </div>
                            </div>
                        </a>
                        <div class="col-4 text-center">
                            <span>
                                <form method="POST" id="unfollow-course-form" action="{{ action('UserController@unfollowCourse') }}">
                                @csrf
                                <input type="hidden" name="course" value={{$followed_course->id}}>
                                <input type="hidden" name="user" value={{auth()->user()->id}}>
                                <span href="javascript:{}" onclick="document.getElementById('unfollow-course-form').submit();">
                                    <i class="far fa-trash-alt"></i>
                                </span>
                                </form>
                            </span>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-md-4">
                {{--<div class="followed-courses-heading">
                        Termíny
                    </div>
                    <div class="followed-courses-content">

                        <div class="row followed-courses-content-header">
                            <div class="col-2" style="text-align:center">
                                <span class="followed-courses-content-header-col">Předmět</span>
                            </div>
                            <div class="col-6">
                                <span class="followed-courses-content-header-col">Termín</span>
                            </div>
                            <div class="col-4" style="text-align:center">
                                <span class="followed-courses-content-header-col">Datum</span>
                            </div>
                        </div>


                    </div>--}}
                    @if($modules->checkModule("Google calendar"))
                        @include('_partials.google_calendar')
                    @endif
        </div>
    </div>
</div>

@include('_partials.google_api')

@endsection
