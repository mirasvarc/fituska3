@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Správa modulů</h2>
            @foreach($modules as $module)
                @if($module->installed == 0)
                    <form action="{{ action('AdminPanelController@installModule') }}" method="POST">
                        @csrf
                        <div class="row mt-25">
                            <div class="col-2">
                                {{$module->name}}
                                <input type="hidden" name="module_id" value="{{$module->id}}">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-success">Instalovat</button>
                            </div>
                        </div>
                    </form>
                @else
                    <form action="{{ action('AdminPanelController@uninstallModule') }}" method="POST">
                        @csrf
                        <div class="row mt-25">
                            <div class="col-2">
                                {{$module->name}}
                                <input type="hidden" name="module_id" value="{{$module->id}}">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-danger">Odinstalovat</button>
                            </div>
                        </div>
                    </form>
                @endif


            @endforeach
        </div>
    </div>
</div>
@endsection
