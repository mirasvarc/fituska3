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
        <div class="col-md-3 offset-md-2">
        @if(Auth::user()->isAdministrator() || Auth::user()->isSUManagement())
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
        @else
            @if(Auth()->user()->id == $user->id)
                <div class="card">
                    <div class="card-header">Správa uživatele</div>
                    <div class="card-body">
                        {!!Form::open(['action' => ['UserController@destroy', $user], 'method' => 'POST', 'onsubmit' => 'return confirm("Opravdu chcete odstranit uživatele?")'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Odstranit uživatele', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!}
                        <span style="color:red">Odstraní uživatele a všechna jeho data</span>
                    </div>
                </div>
            @endif
        @endif
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="roleErrModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upozornění</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Odebráním této role bude předána jinému uživateli. Opravdu si přejete roli odebrat?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ponechat roli</button>
                <form method="post" action="{{ route('chooseAdmin') }}">
                    @csrf
                    <input name="curr_user" type="hidden" value="{{$user->id}}">
                    <button type="submit" class="btn btn-primary">Odebrat roli</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="delErrModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upozornění</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Smazáním tohoto uživatele bude role Administrátor přidána jinému uživateli. Chcete opravdu odstranit uživatele?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zpět</button>
                <form method="post" action="{{ route('chooseAdmin') }}">
                    @csrf
                    <input name="del" type="hidden" value=1>
                    <input name="curr_user" type="hidden" value="{{$user->id}}">
                    <button type="submit" class="btn btn-primary">Odstranit uživatele</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="errChooseAdminModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upozornění</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Tuto akci nelze provést, kontaktuje správce.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zpět</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
    @if(isset($_REQUEST['err']))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#roleErrModal').modal('show');
            });
        </script>
    @endif

    @if(isset($_REQUEST['delErr']))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#delErrModal').modal('show');
            });
        </script>
    @endif

    @if(isset($_REQUEST['errChooseAdmin']))
        <script type="text/javascript">
            $(window).on('load',function(){
                $('#errChooseAdminModal').modal('show');
            });
        </script>
    @endif
@endpush
