@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-left">
            <h1>Přijaté formuláře</h1>
        </div>
    </div>
    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <table>
                <tr class="forms-table">
                    <th style="width:50px">ID</th>
                    <th style="width:200px">Jméno a příjmení</th>
                    <th style="width:250px">Email</th>
                    <th style="max-width:600px">Dotaz</th>
                </tr>
            @foreach($forms as $form)
                <tr class="forms-table">
                    <td>
                        #{{$form->id}}
                    </td>
                    <td>
                        {{$form->full_name}}
                    </td>
                    <td>
                        <a href="mailto:{{$form->email}}">{{$form->email}}</a>
                    </td>
                    <td>
                        {{$form->msg}}
                    </td>
                </tr>
            @endforeach
            </table>
        </div>
    </div>

</div>
@endsection

<style>
    .forms-table {
        border-bottom: 1px solid grey;
    }
    .forms-table td, .forms-table th {
        padding: 25px 10px
    }
</style>
