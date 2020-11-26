@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-25">
                <div class="card-header">Profil</div>

                <div class="card-body">
                    <table style="width:100%;font-size:15px;">
                        <tr>
                            <td>Uživatelské jméno:</td>
                            <td style="font-weight: 800">{{ $user->username}}<td>
                        </tr>
                        <tr>
                            <td>Školní mail: </td>
                            <td style="font-weight: 800">{{ $user->school_mail}}</td>
                        </tr>
                        <tr>
                            <td>Role: </td>
                            <td style="font-weight: 800">
                                {{$roles_string}}
                            </td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                        <tr>
                            <td>Jméno a příjmení:</td>
                            <td style="font-weight: 800">{{ $user->first_name}} {{$user->surname}}<td>
                        </tr>
                        <tr>
                            <td>Osobní email:</td>
                            <td style="font-weight: 800">{{ $user->mail}}</td>
                        </tr>
                        <tr>
                            <td>Ročník:</td>
                            <td style="font-weight: 800">{{ $user->year_of_study}}</td>
                        </tr>
                        <tr>
                            <td>O mě:</td>
                            <td style="font-weight: 800">{{ $user->about}}</td>
                        </tr>
                    </table>
                    @if($user->id == Auth::user()->id || Auth::user()->isAdministrator())
                    <a href="/user/{{$user->id}}/edit" class="btn btn-primary mt-25 text-white">Upravit profil</a>
                    @endif
                </div>
            </div>


            <div class="card mt-25">
                <div class="card-header">Nastavení</div>

                <div class="card-body">
                    <form action="{{ route('changeSettings') }}" method="POST">
                        @csrf
                        <div class="form-section">
                            <input type="hidden" name="user" value="{{$user->id}}">
                            <input type="checkbox" id="compact-checkbox" name="compact" class="checkbox ml-10 mt-10" @if(isset($user_settings->user_settings_json) && $user_settings->user_settings_json['compact_mode'] == 'true') checked @endif>
                            <label for="compact-checkbox" class="ml-10">Kompaktní mód</label>
                        </div>
                        <div class="form-section mt-25 ml-10">
                            <button type="submit" class="btn btn-primary">Uložit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if(Auth::user()->isAdministrator() || Auth::user()->isSUManagement())
        <div class="col-md-3 offset-md-2">
            <div class="card">
                <div class="card-header">Přidat / odebrat role</div>
                <div class="card-body">
                    <p class="bold">Přidat</p>
                    {!! Form::open(['action' => ['UserController@addRole'], 'method' => 'POST']) !!}
                        {!! Form::select('roles', $roles_dont_have, null, ['class'=>'form-control']) !!}
                        {!! Form::hidden('user', $user->id) !!}
                        {!! Form::submit('Přidat roli', ['class'=>'mt-10 btn btn-success']) !!}
                    {!! Form::close() !!}
                    <p class="mt-25 bold">Odebrat</p>
                    {!! Form::open(['action' => ['UserController@removeRole'], 'method' => 'POST']) !!}
                        {!! Form::select('roles', $roles_have, null, ['class'=>'form-control']) !!}
                        {!! Form::hidden('user', $user->id) !!}
                        {!! Form::submit('Odebrat roli', ['class'=>'mt-10 btn btn-danger']) !!}
                    {!! Form::close() !!}
                </div>
            </div>

            <div class="card mt-25">
                <div class="card-header">Správa uživatele</div>
                <div class="card-body">
                    {!!Form::open(['action' => ['UserController@destroy', $user], 'method' => 'POST', 'onsubmit' => 'return confirm("Opravdu chcete odstranit uživatele?")'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Odstranit uživatele', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                    <span style="color:red">Odstraní uživatele a všechna jeho data</span>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
