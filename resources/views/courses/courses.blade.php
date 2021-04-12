@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           {{-- @include('_partials/courses_list')
            {{--<livewire:courses-table />--}}
            @livewire('courses-table')
        </div>
    </div>
</div>
@endsection
