<div class="row">
    <div class="col-12">
        <h1 class="course-h1" id="{{$course->code}}">
            @if(!auth()->user()->isFollowingCourse($course->id))
            <form method="POST" action="{{ action('UserController@followCourse') }}">
                @csrf
                [{{$course->code}}] {{$course->full_name}}
                <input type="hidden" name="course" value={{$course->id}}>
                <input type="hidden" name="user" value={{auth()->user()->id}}>
                <button class="btn btn-primary" style="margin-left:15px;">
                    <i class="fa fa-plus-circle"></i>
                    &nbsp;
                    Sledovat
                </button>
            </form>

            @else
            <form method="POST" action="{{ action('UserController@unfollowCourse') }}">
                @csrf
                [{{$course->code}}] {{$course->full_name}}
                <input type="hidden" name="course" value={{$course->id}}>
                <input type="hidden" name="user" value={{auth()->user()->id}}>
                <button class="btn btn-success" id="btn-following" style="margin-left:15px;">
                    <i class="fa fa-check-circle"></i>
                    &nbsp;
                    <span>Sledováno</span>
                </button>
            </form>
            @endif
        </h1>
    </div>
</div>
