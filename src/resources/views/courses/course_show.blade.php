@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>[{{$course->code}}] {{$course->full_name}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="new-post">
                <button class="btn btn-primary">
                    <a href="/course/{{$course->code}}/create-post">
                        <i class="fa fa-plus-circle"></i>
                        &nbsp;
                        Nový příspěvek
                    </a>
                </button>
            </div>
        </div>
        <div class="col-6">
            <div class="course-detail-menu" style="margin-right:50px;">
                <label for="types" style="margin-right:10px;">Typ: </label>
                <select id="types" name="types" form="typesform">
                    <option value="Zadání">Zadání</option>
                    <option value="Materiály">Materiály</option>
                    <option value="Diskuze">Diskuze</option>
                    <option value="Ostatní">Ostatní</option>
                </select>

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
                    <div class="col-2" style="text-align:center">
                        <span class="posts-header">Komentáře</span>
                    </div>
                </div>
                @foreach($posts as $post)
                <a href="/post/{{$course->code}}/{{$post->id}}" class="post-link">
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
                    <div class="col-2" style="text-align:center">
                        <i class="far fa-comment"></i>
                        <span>{{count($post->comments()->get())}}</span>
                    </div>
                </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection


