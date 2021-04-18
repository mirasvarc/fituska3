@if(isset($course->calendar_id))
    <input type="hidden" value="{{$course->calendar_id}}" id="course-name">
@else
    <input type="hidden" value="fituska.mail@gmail.com" id="course-name">
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


        &nbsp;
        <button id="follow_button" class="btn btn-primary" onclick="followCalendar();">
            <i class="fa fa-plus-circle"></i>
            &nbsp;
            Sledovat
        </button>
        <button id="unfollow_button" style="display: none;" class="btn btn-secondary" onclick="unfollowCalendar();">
            <i class="fa fa-check-circle"></i>
            &nbsp;
            <span>Sledováno</span>
        </button>
    </div>
    <div class="calendar-body">
        <div class="calendar-events">

        </div>
        <div class="calendar-add-btn text-center">
            @if(Auth()->user()->canModerate())
                <button id="addCalendarEvent" class="btn btn-success btn-addEvent" data-toggle="modal" data-target="#add-event-modal">
                    <i class="fa fa-plus-circle"></i>
                    &nbsp;Přidat událost
                </button>
            @endif
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
                <form method="post" action="javascript:void(0);">
                    @csrf
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
                    <input type="submit" onclick="addCalEvent()" data-dismiss="modal" class="btn btn-success btn-addEvent" value="Přidat">
                </form>
            </div>
        </div>
    </div>
</div>

