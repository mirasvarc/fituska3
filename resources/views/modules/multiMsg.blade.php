@inject('modules', 'App\Modules')
@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="multimsg-upper-menu">
                @if($modules->checkModule('Facebook api'))
                <div id="discussion-btn" class="course-menu-btn active-btn">Facebook</div>
                @endif
                @if($modules->checkModule('Discord api'))
                <div id="files-btn" class="course-menu-btn">Discord</div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('.course-menu-btn').on("click", function(){
        $('.active-btn').removeClass('active-btn');
        $(this).addClass('active-btn');

    });

    $('#discussion-btn').on('click', function(){
        $('#discussion-body').show();
        $('#files-body').hide();
    });
    $('#files-btn').on('click', function(){
        $('#discussion-body').hide();
        $('#files-body').show();
    });
    $('#exams-btn').on('click', function(){
        $('#discussion-body').hide();
        $('#files-body').hide();
    });
</script>
@endpush
