@extends('layouts.app')

@section('content')
@if($user->id == Auth::user()->id || Auth::user()->isAdministrator())
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-25">
                    <div class="card-header">Úprava profilu</div>

                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" class="form form-horizontal" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-section">
                                        <label for="username">Uživatelské jméno *</label>
                                        <input type="text" name="username" id="username" class="form-control" required value="{{$user->username}}">
                                    </div>
                                    <div class="form-section mt-25">
                                        <label for="new_password">Nové heslo</label>
                                        <input type="password" name="new_password" id="new_password" class="form-control">
                                    </div>
                                    <div class="form-section mt-25">
                                        <label for="old_password">Staré heslo *</label>
                                        <input type="password" name="old_password" id="old_password" class="form-control" required>
                                    </div>
                                    <div class="form-section mt-25">
                                        <label for="first_name">Jméno</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{$user->first_name}}">
                                    </div>
                                    <div class="form-section mt-25">
                                        <label for="surname">Příjmení</label>
                                        <input type="text" name="surname" id="surname" class="form-control" value="{{$user->surname}}">
                                    </div>
                                    <div class="form-section mt-25">
                                        <label for="mail">Osobní email</label>
                                        <input type="mail" name="mail" id="mail" class="form-control" value="{{$user->mail}}">
                                    </div>
                                    <div class="form-section mt-25">
                                        <label for="about">O mě</label>
                                        <textarea type="text" name="about" id="about" class="form-control">{{$user->about}}</textarea>
                                    </div>
                                    <div class="form-section mt-25 text-center">
                                        <input type="submit" value="Uložit" class="mt-25 btn btn-primary ">
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>



            </div>

        </div>
    </div>
@else
    <script>
        window.location.replace('/user/{{$user->id}}');
    </script>
@endif
@endsection
