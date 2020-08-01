@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
                <div class="back-button">
                    <button class="btn btn-primary">
                        <a href="/course/{{$course->code}}">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            &nbsp;
                            Zpět
                        </a>
                    </button>
                    @if($post->isAuthor())

                        {!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'onsubmit' => 'return confirm("Opravdu chcete smazat příspěvek?")', 'style' => 'float:right;margin-right:15px;'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::button('<i class="fa fa-trash-alt"></i> Odstranit', ['type' => 'submit', 'class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}

                    <button class="btn btn-primary" style="float:right;margin-right:5px;">
                        <a href="/post/{{$course->code}}/{{$post->id}}/edit">
                            <i class="fa fa-edit"></i>
                            Upravit
                        </a>
                    </button>
                    @endif
                </div>

            <div class="post">
                <div class="post-title">
                    <h1>{{$post->title}}</h1>
                    <p><a href="/user/{{$post->author()->first()->id}}">{{$post->author()->first()->username}}</a>, {{$post->created_at}}</Datum:>
                </div>
                <div class="post-content">
                    {!!html_entity_decode($post->content)!!}
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
