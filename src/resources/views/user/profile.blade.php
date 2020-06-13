@extends('layouts.app')

@section('content')
<style>
    td {
        font-size:45px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
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
                    </table>
                </div>
            </div>
        </div>
        @if(Auth::user()->isAdministrator() || Auth::user()->isSUManagement())
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Přidat role</div>
                <div class="card-body">
                    {!! Form::open(['action' => ['UserController@addRole'], 'method' => 'POST']) !!}
                        {!! Form::select('roles', $roles_dont_have, null, ['class'=>'form-control']) !!}
                        {!! Form::hidden('user', $user->id) !!}
                        {!! Form::submit('Přidat roli') !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card">
                <div class="card-header">Odebrat role</div>
                <div class="card-body">
                    {!! Form::open(['action' => ['UserController@removeRole'], 'method' => 'POST']) !!}
                        {!! Form::select('roles', $roles_have, null, ['class'=>'form-control']) !!}
                        {!! Form::hidden('user', $user->id) !!}
                        {!! Form::submit('odebrat roli') !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card">
                <div class="card-header">Správa uživatele</div>
                <div class="card-body">
                    {!!Form::open(['action' => ['UserController@destroy', $user], 'method' => 'POST', 'onsubmit' => 'return confirm("Opravdu chcete odstranit uživatele?")'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Odstranit uživatele', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                    &nbsp;
                    <span style="color:red">Odstraní uživatele a všechna jeho data</span>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
