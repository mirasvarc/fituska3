@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Uživatelské jméno</th>
                            <th>Školní email</th>
                            <th>Email</th>
                            <th>Ročník</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td><a href="{{ route('user.show',$user->id) }}">{{$user->username}}</a></td>
                                <td>{{$user->school_mail}}</td>
                                <td>{{$user->mail}}</td>
                                <td>{{$user->year_of_study}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

        </div>
    </div>
</div>
@endsection
