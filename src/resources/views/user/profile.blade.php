@extends('layouts.app')

@section('content')
<style>
    td {
        font-size:45px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                                {{$roles}}
                            </td>
                        </tr>
                    <table>
            </div>
        </div>
    </div>
</div>
@endsection
