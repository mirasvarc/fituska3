@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Soubory k předmětu {{$course->full_name}}</h2>
        </div>
    </div>


    <div class="row">
        <div class="col-8">
            <div class="course-posts">
                <div class="row course-post-header-compact">
                    <div class="col-4">
                        <span class="posts-header">Název souboru</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span class="posts-header">Typ</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span class="posts-header">Datum vložení</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span class="posts-header">Autor</span>
                    </div>
                </div>
                @foreach($files as $file)
                <div class="row course-post-compact">
                    <div class="col-4">
                        <a href="/storage/files/{{$course->code}}/{{$file->path}}" target="_blank">{{$file->name}}</a>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span class="normal">{{$file->type}}</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span>{{$file->created_at}}</span>
                    </div>
                    <div class="col-2" style="text-align:center">
                        <span>XX</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-4">
            <div class="add-file-btn text-center mt-25">
                <a href="" class="btn bnt-primary">
                    <i class="fas fa-upload"></i>
                    <span>Nahrát soubor</span>
                </a>
            </div>

        </div>

    </div>



</div>
@endsection
