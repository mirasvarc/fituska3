@if(isset($course->calendar_id))
    <input type="hidden" value="{{$course->calendar_id}}" id="course-name">
@else
    <input type="hidden" value="fituska.mail@gmail.com" id="course-name">
@endif

@if(isset($course->code))
<input type="hidden" value="{{$course->code}}" id="course-code">
@endif

<div class="calendar-container">
    <div class="calendar-header">
        <h1>Kalendář</h1>


        &nbsp;
        <button id="authorize_button" style="display: none;" class="btn btn-primary">
            Autorizovat
        </button>
        <button id="signout_button" style="display: none;" class="btn btn-secondary">
            <span>XXX</span>
        </button>

        @if(isset($course->code))
        &nbsp;
        <button id="follow_button" class="btn btn-primary" @if(auth()->user()->isFollowingCalendar($course->calendar_id)) style="display: none;" @endif onclick="followCalendar();">
            <i class="fa fa-plus-circle"></i>
            &nbsp;
            Sledovat
        </button>
        <button id="unfollow_button" @if(!auth()->user()->isFollowingCalendar($course->calendar_id)) style="display: none;" @endif class="btn btn-success" onclick="unfollowCalendar();">
            <i class="fa fa-check-circle"></i>
            &nbsp;
            <span>Sledováno</span>
        </button>
        @endif
    </div>
    <div class="calendar-body">
        <div class="calendar-events">
            @if(empty($calendar_events))
            <div class="calendar-event">
                <span class="event-name">
                    Žádná událost nenalezena
                </span>
            </div>
            @else
                @foreach ($calendar_events as $event)
                <div class="calendar-event">
                    <span class="event-name">
                        {{$event->summary}}
                    </span>
                    <span class="event-date">

                        {{date_format(date_create($event->start->dateTime), "d.m.Y H:i")}}
                    </span>
                </div>
                @endforeach
            @endif
        </div>
        <div class="calendar-add-btn text-center">
            <button id="addCalendarEvent" class="btn btn-success btn-addEvent" data-toggle="modal" data-target="#add-event-modal">
                <i class="fa fa-plus-circle"></i>
                &nbsp;Přidat událost
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-event-modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Přidat událost do kalendáře</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('add-calendar-event') }}" id="add-event-form">
                    @csrf
                    @if(isset($course->code))
                        <input type="hidden" name="course" value="{{$course->code}}" id="course">
                    @endif
                    <div class="form-group">
                        <label for="event_name">Název: *&nbsp;</label>
                        <input type="text" name="event_name" class="form-control" required id="EventName">
                    </div>
                    <div class="form-group">
                        <label for="event_decs">Popis:&nbsp;</label>
                        <input type="text" name="event_decs" class="form-control" id="EventDesc">
                    </div>
                    <div class="form-group">
                        <label for="event_date">Datum a čas: *&nbsp;</label>
                        <input type="datetime-local" name="event_date" class="form-control" required id="EventDate">
                    </div>
                    <input type="submit" data-dismiss="modal" class="btn btn-success btn-addEvent" onclick="add_event()" value="Přidat">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function add_event() {
        document.getElementById("add-event-form").submit();
    }


    $('#unfollow_button').hover(function () {
        $(this).addClass('btn-danger');
        $(this).removeClass('btn-success');
        $('#unfollow_button svg').removeClass('fa-check-circle');
        $('#unfollow_button svg').addClass('fa-times-circle');
        //$('#btn-following span').html("Přestat sledovat");
    }, function () {
        $(this).removeClass('btn-danger');
        $(this).addClass('btn-success');
        //$('#btn-following span').html("Sledováno");
        $('#unfollow_button svg').addClass('fa-check-circle');
        $('#unfollow_button svg').removeClass('fa-times-circle');
    });

</script>

