@inject('user', 'App\User')
@inject('role', 'App\Role')
@extends('layouts.admin')

@section('content')

<div class="container">
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
                            <p>{{$role->getRole($vote->current_role)->role}}</p>
                        </div>
                        <div class="col-md-2">
                            <p>{{$role->getRole($vote->vote_role)->role}}</p>
                        </div>
                        <div class="col-md-2">
                            <p>{{$vote->vote_yes}}</p>
                        </div>
                        <div class="col-md-2">
                            <p>{{$vote->vote_no}}</p>
                        </div>
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
                    </div>
                @endforeach
            @else
                <p>Momentálně neprobíhá žádné hlasování.</p>
            @endif
        </div>
    </div>
</div>
@endsection
