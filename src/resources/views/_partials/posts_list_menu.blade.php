<div class="row">
    <div class="col-12">
        <h1>

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
<div class="row">
    <div class="col-4">
        <div class="new-post">
            <button class="btn btn-primary">
                <a href="/course/{{$course->code}}/create-post">
                    <i class="fa fa-plus-circle"></i>
                    &nbsp;
                    Nový příspěvek
                </a>
            </button>
        </div>
    </div>
    <div class="col-4">
        <div class="course-detail-menu" style="margin-right:50px;">
            <label for="types" style="margin-right:10px;">Typ: </label>
            <select id="types" name="types" form="typesform">
                <option value="Zadání">Zadání</option>
                <option value="Materiály">Materiály</option>
                <option value="Diskuze">Diskuze</option>
                <option value="Ostatní">Ostatní</option>
            </select>

        </div>
    </div>
</div>
