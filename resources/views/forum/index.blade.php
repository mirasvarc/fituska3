@extends('layouts.app')

@section('content')
    <div class="container">

        @if(Auth::user()->canModerate())
        <div class="row">
            <div class="col-md-2 col-6">
                <div class="new-post">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-topic-modal">
                        <i class="fa fa-plus-circle"></i>
                        &nbsp;
                        Nové téma
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="create-topic-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Vytvořit nové téma</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <form action="/forum/create-topic" class="form" method="POST">
                            @csrf
                            <label for="topic-name">Název</label>
                            <input type="hidden" name="forum_id" value=1>
                            <input type="text" name="topic_name" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zpět</button>
                        <button type="submit" class="btn btn-primary">Vytvořit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
