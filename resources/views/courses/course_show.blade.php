@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            @include('_partials.course_header')
            @include('_partials/topics_list_menu')

            <span id="discussion-body">
                @include('_partials.topics')
            </span>

            <span id="files-body" style="display: none">
               @include('courses.course_files')
            </span>

            @if(auth()->user()->canSeeExams())
            <span id="exams-body" style="display: none">
                @include('courses.course_exams')
            </span>
            @endif
            {{--@if($user_settings['compact_mode'] == 'true')
                @include('_partials/posts_list_compact')
            @else
                @include('_partials/posts_list')
            @endif--}}
        </div>
        <div class="col-md-4">
            @include('_partials.google_calendar')
        </div>
    </div>
</div>
@endsection



@push('scripts')

@include('_partials.google_api')

<script>
    $('#btn-following').hover(function () {
        $(this).addClass('btn-danger');
        $(this).removeClass('btn-success');
        $('#btn-following svg').removeClass('fa-check-circle');
        $('#btn-following svg').addClass('fa-times-circle');
        //$('#btn-following span').html("Přestat sledovat");
    }, function () {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        //$('#btn-following span').html("Sledováno");
        $('#btn-following svg').addClass('fa-check-circle');
        $('#btn-following svg').removeClass('fa-times-circle');
    });


</script>
@endpush
