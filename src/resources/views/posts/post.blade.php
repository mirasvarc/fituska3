@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
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
