@inject('modules', 'App\Modules')
@extends('layouts.app')

@section('content')

@php
    $fb_groups = [['id' => 1, 'name' => 'FIT BIT 2016-2019'], ['id' => 2, 'name' => 'FIT BIT 2017-2020']];

@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="multimsg-upper-menu">
                @if($modules->checkModule('Facebook API'))
                <div id="fb-btn" class="course-menu-btn active-btn">Facebook</div>
                @endif
                @if($modules->checkModule('Discord API'))
                <div id="dc-btn" class="course-menu-btn">Discord</div>
                @endif
            </div>
        </div>
    </div>

    <div id="fb-body" class="row multi-msg-form">
        <div class="col-md-12">
            <p class="heading">Poslat zprávu do vybraných facebookových skupin</p>
            <form action="{{route('send-fb-multimsg')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-2 groups-panel">
                        <div class="form-group text-center">
                        @foreach($fb_groups as $group)
                            <label for="{{$group['id']}}">{{$group['name']}}</label>
                            <input type="checkbox" class="checkbox" name="{{$group['id']}}"><br>
                        @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 msg-panel">
                        <div class="form-group">
                            <textarea placeholder="Text ..." name="text"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-right">
                        <input type="hidden" name="user" value="{{Auth()->user()}}">
                        <input class="btn btn-primary multimsg-submit" type="submit" value="Odeslat">
                    </div>
                </div>
            </form>
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

    $('#fb-btn').on('click', function(){
        $('#fb-body').show();
        $('#dc-body').hide();
    });
    $('#dc-btn').on('click', function(){
        $('#fb-body').hide();
        $('#dc-body').show();
    });

</script>
@endpush
