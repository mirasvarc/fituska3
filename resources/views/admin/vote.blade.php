@inject('user', 'App\User')
@inject('role', 'App\Role')
@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary text-white"  data-toggle="modal" data-target="#modelId">
                <i class="fa fa-plus-circle"></i>
                &nbsp;Nové hlasování
            </button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <h2>Hlasování</h2>
            @if($all_votes != null)
                <div class="row pt-25">
                    <div class="col-md-2">
                        <p>Uživatelské jméno</p>
                    </div>
                    <div class="col-md-2">
                        <p>Aktuální role</p>
                    </div>
                    <div class="col-md-2">
                        <p>Nová role</p>
                    </div>
                    <div class="col-md-2">
                        <p>Počet hlasů pro</p>
                    </div>
                    <div class="col-md-2">
                        <p>Počet hlasů proti</p>
                    </div>
                    <div class="col-md-2 text-center">
                        <p>Hlasovat</p>
                    </div>
                </div>
                @foreach($all_votes as $vote)
                    <div class="row">
                        <div class="col-md-2">
                            <a href="/user/{{$user->getUser($vote->user_id)->id}}">{{$user->getUser($vote->user_id)->username}}</a>
                        </div>
                        <div class="col-md-2">
                            <p>{{$role->getRole($vote->role_current)->role}}</p>
                        </div>
                        <div class="col-md-2">
                            <p>{{$role->getRole($vote->role_new)->role}}</p>
                        </div>
                        <div class="col-md-2">
                            <p>{{$vote->vote_yes}}</p>
                        </div>
                        <div class="col-md-2">
                            <p>{{$vote->vote_no}}</p>
                        </div>
                        @if($vote->hasUserVoted(Auth()->user()->id, $vote->id))
                            <div class="col-md-2 text-center">
                                <p class="red">Již jste hlasoval.</p>
                            </div>
                        @else
                        <div class="col-md-1 text-center">
                            <form action="{{ action('AdminPanelController@voteYes') }}" method="POST">
                                @csrf
                                <input type="hidden" name="vote_id" value="{{$vote->id}}">
                                <input type="hidden" name="vote_yes" value="{{$vote->vote_yes + 1}}">
                                <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></a>
                            </form>
                        </div>
                        <div class="col-md-1 text-center">
                            <form action="{{ action('AdminPanelController@voteNo') }}" method="POST">
                                @csrf
                                <input type="hidden" name="vote_id" value="{{$vote->id}}">
                                <input type="hidden" name="vote_no" value="{{$vote->vote_no + 1}}">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i></a>
                            </form>
                        </div>
                        @endif
                    </div>
                @endforeach
            @else
                <p>Momentálně neprobíhá žádné hlasování.</p>
            @endif
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vybrat uživatele pro ověření</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => ['AdminPanelController@createVote'], 'method' => 'POST']) !!}
                    {!! Form::select('users', $users, null, ['class'=>'form-control']) !!}
                    {!! Form::submit('Vytvořit hlasování', ['class'=>'mt-10 btn btn-success']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@endsection
