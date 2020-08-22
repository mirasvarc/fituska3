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
                        <div class="col-6" style="text-align:center">
                            <span class="followed-courses-content-header-col">Název</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span class="followed-courses-content-header-col">Ročník</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span class="followed-courses-content-header-col">Typ</span>
                        </div>
                    </div>
                    @foreach($followed_courses as $followed_course)
                    <a href="/course/{{$followed_course->code}}" class="followed-courses-content-link">
                    <div class="row followed-courses-content-course">
                        <div class="col-2">
                            {{$followed_course->code}}
                        </div>
                        <div class="col-6" style="text-align:center">
                            <span>{{$followed_course->full_name}}</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span>{{$followed_course->study_year}}</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span>{{$followed_course->type}}</span>
                        </div>
                    </div>
                    </a>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="col-md-4">
                <div class="followed-courses-heading">
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


                    </div>
        </div>
    </div>
</div>
@endsection
