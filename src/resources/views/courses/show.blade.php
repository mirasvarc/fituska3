@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>[{{$course->code}}] {{$course->full_name}}</h1>
            <h3>Rok: {{$course->year}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="course-detail-menu">
                <div>Vše</div>
                <div>Zadání písemek</div>
                <div>Materiály</div>
                <div>Diskuze</div>
                <div>Ostatní</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="course-posts">
                <div class="row course-post-header">
                    <div class="col-4">
                        <span class="posts-header">Název</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span class="posts-header">Typ</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span class="posts-header">Datum</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span class="posts-header">Autor</span>
                    </div>
                </div>
                @foreach($posts as $post)
                <div class="row course-post">
                    <div class="col-4">
                        {{$post->title}}
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span class="post-type">{{$post->type}}</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span>{{$post->created_at}}</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span>{{$post->author()->first()->username}}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection


