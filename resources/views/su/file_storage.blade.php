@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-6">
            <div class="new-post">
                <button class="btn btn-primary" data-toggle="modal" data-target="#upload-file">
                    <i class="fa fa-upload"></i>
                    &nbsp;
                    Nahrát soubor
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="upload-file" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nahrát soubor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('su.file.upload') }}" class="form form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="files">Přiložit soubory</label>
                            <input type="file" id="files" class="form-control-file" name="files[]" multiple>
                        </div>
                        <div class="form-group">
                            <label for="su_private">Pouze pro uživatele s rolí Vedení SU</label>
                            <input type="checkbox" id="su-private" class="form-control-file" name="su_private">
                        </div>
                        <button type="submit" class="btn btn-primary">Nahrát</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @if(auth()->user()->isSUManagement())
    <h2 class="mt-25">Soubory vedení</h2>
    <p>K těmto souborům mají přístup pouze uživatelé s rolí Vedení SU</p>
    <div class="row">
        <div class="col-10">
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
                @foreach($su_files_private as $file)
                    <div class="row course-post-compact">
                        <div class="col-4">
                            <a href="/storage/files/su/{{$file->path}}" target="_blank">{{$file->name}}</a>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span class="normal">{{$file->type}}</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span>{{$file->created_at}}</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            @if($file->author()->first())
                            <span><a href="/user/{{$file->author()->first()->id}}">{{$file->author()->first()->username}}</a></span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    @endif
    <h2 class="mt-25">Soubory</h2>
    <div class="row">
        <div class="col-10">
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
                @foreach($su_files as $file)
                    <div class="row course-post-compact">
                        <div class="col-4">
                            <a href="/storage/files/su/{{$file->path}}" target="_blank">{{$file->name}}</a>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span class="normal">{{$file->type}}</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            <span>{{$file->created_at}}</span>
                        </div>
                        <div class="col-2" style="text-align:center">
                            @if($file->author()->first())
                            <span><a href="/user/{{$file->author()->first()->id}}">{{$file->author()->first()->username}}</a></span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

@endsection
