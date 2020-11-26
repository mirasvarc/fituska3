@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="course-posts">
                    <div class="row course-post-header">
                        <div class="col-lg-10 col-2">
                            <span class="posts-header">Název</span>
                        </div>



                    </div>
                    @foreach($forums as $forum)
                    <a href="/forum/{{$forum->id}}" class="post-link">

                        <div class="row course-post" id="{{$forum->id}}">

                            <div class="col-lg-10 col-2">
                                {{$forum->name}}
                            </div>

                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
