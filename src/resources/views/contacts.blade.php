@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <h1>Kontakty</h1>
        </div>
    </div>
    <div class="row justify-content-center pt-25">
        <div class="col-md-6">
            <div class="card mb-25">
                <div class="card-header">Administrátoři</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <th style="width:150px">Jméno</th>
                            <th>Email</th>
                        </tr>
                    @foreach($admins as $admin)
                        <tr>
                            <td>
                                <a href="/user/{{$admin->id}}">{{$admin->first_name}} {{$admin->surname}}</a>
                            </td>
                            <td>
                                <a href="mailto:{{$admin->school_mail}}">{{$admin->school_mail}}</a>
                            </td>
                        </tr>

                    @endforeach
                    </table>
                </div>
            </div>
            <div class="card mb-25">
                <div class="card-header">Moderátoři</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <th style="width:150px">Jméno</th>
                            <th>Email</th>
                        </tr>
                    @foreach($moderators as $moderator)
                        <tr>
                            <td>
                                <a href="/user/{{$moderator->id}}">{{$moderator->first_name}} {{$moderator->surname}}</a>
                            </td>
                            <td>
                                <a href="mailto:{{$moderator->school_mail}}">{{$moderator->school_mail}}</a>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>

            <div class="card mb-25">
                <div class="card-header">Studentská unie</div>

                <div class="card-body">
                    <table>
                        <tr>
                            <th style="width:150px">Jméno</th>
                            <th>Email</th>
                        </tr>
                    @foreach($su as $su_user)
                        <tr>
                            <td>
                                <a href="/user/{{$su_user->id}}">{{$su_user->first_name}} {{$su_user->surname}}</a>
                            </td>
                            <td>
                                <a href="mailto:{{$su_user->school_mail}}">{{$su_user->school_mail}}</a>
                            </td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>


        </div>

    </div>
</div>
@endsection
