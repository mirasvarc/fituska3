@if(isset($course->calendar_id))
    <input type="hidden" value="{{$course->calendar_id}}" id="course-name">
@else
    <input type="hidden" value="primary" id="course-name">
@endif

<div class="calendar-container">
    <div class="calendar-header">
        <h1>Kalendář</h1>


        &nbsp;
        <button id="authorize_button" style="display: none;" class="btn btn-secondary">Autorizovat</button>
        <button id="signout_button" style="display: none;" class="btn btn-secondary">Odhlásit</button>
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

<script type="text/javascript">

    var calendar_id = $('#course-name').val();

    moment.locale('cs');

    function addCalEvent(){

        var eventName = $('#EventName').val();
        var eventDesc = $('#EventDesc').val();
        var eventDate = $('#EventDate').val();
        console.log(moment(eventDate).format())
        var event = {
            'summary': eventName,
            'description': eventDesc,
            'start': {
                'dateTime': moment(eventDate).format(),
                'timeZone': 'Europe/Prague'
            },
            'end': {
                'dateTime': moment(eventDate).format(),
                'timeZone': 'Europe/Prague'
            },
        };

        var request = gapi.client.calendar.events.insert({
            'calendarId': calendar_id,
            'resource': event
        });

        request.execute(function(event) {
            console.log("Event created!")
            $('#add-event-modal').modal('hide');
            var when = event.start.dateTime;
            if (!when) {
                when = event.start.date;
            }
            appendPre('<span class="event-name">' + event.summary + '</span><span class="event-date">' + moment(when).format('llll') + '</span>')
            //appendPre('Event created: ' + event.htmlLink);
        });
    }

    // Client ID and API key from the Developer Console
    var CLIENT_ID = '923025024916-8m1fat5k5g2puvo5vlfkinahhme341eg.apps.googleusercontent.com';
    var API_KEY = 'AIzaSyB4YivkSauKMid6EXKVdJap5_wNHCYLxQ4';

    // Array of API discovery doc URLs for APIs used by the quickstart
    var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];

    // Authorization scopes required by the API; multiple scopes can be
    // included, separated by spaces.
    var SCOPES = "https://www.googleapis.com/auth/calendar";

    var authorizeButton = document.getElementById('authorize_button');
    var signoutButton = document.getElementById('signout_button');

    /**
    *  On load, called to load the auth2 library and API client library.
    */
    function handleClientLoad() {
        gapi.load('client:auth2', initClient);
    }

    /**
    *  Initializes the API client library and sets up sign-in state
    *  listeners.
    */
    function initClient() {
        gapi.client.init({
            apiKey: API_KEY,
            clientId: CLIENT_ID,
            discoveryDocs: DISCOVERY_DOCS,
            scope: SCOPES
        }).then(function () {
            // Listen for sign-in state changes.
            gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

            // Handle the initial sign-in state.
            updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
            authorizeButton.onclick = handleAuthClick;
            signoutButton.onclick = handleSignoutClick;
        }, function(error) {
            appendPre(JSON.stringify(error, null, 2));
        });
    }

    /**
    *  Called when the signed in status changes, to update the UI
    *  appropriately. After a sign-in, the API is called.
    */
    function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
            authorizeButton.style.display = 'none';
            signoutButton.style.display = 'block';
            listUpcomingEvents();
        } else {
            authorizeButton.style.display = 'block';
            signoutButton.style.display = 'none';
        }
    }

    /**
    *  Sign in the user upon button click.
    */
    function handleAuthClick(event) {
        gapi.auth2.getAuthInstance().signIn();
    }

    /**
    *  Sign out the user upon button click.
    */
    function handleSignoutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
    }

    /**
    * Append a pre element to the body containing the given message
    * as its text node. Used to display the results of the API call.
    *
    * @param {string} message Text to be placed in pre element.
    */
    function appendPre(message) {
        $('.calendar-events').append('<div class="calendar-event">' + message + '</div>\n');
    }

    /**
    * Print the summary and start datetime/date of the next ten events in
    * the authorized user's calendar. If no events are found an
    * appropriate message is printed.
    */
    function listUpcomingEvents() {
        gapi.client.calendar.events.list({
            'calendarId': calendar_id,
            'timeMin': (new Date()).toISOString(),
            'showDeleted': false,
            'singleEvents': true,
            'maxResults': 10,
            'orderBy': 'startTime'
        }).then(function(response) {
            var events = response.result.items;

            if (events.length > 0) {
                for (i = 0; i < events.length; i++) {
                    console.log(event)
                    var event = events[i];
                    var when = event.start.dateTime;
                    if (!when) {
                        when = event.start.date;

                    }
                    // TODO: build event node
                    appendPre('<span class="event-name">' + event.summary + '</span><span class="event-date">' + moment(when).format('llll') + '</span>')
                }
            } else {
                appendPre('Žádné nadcházející události.');
            }
        });
    }

</script>

<script async defer src="https://apis.google.com/js/api.js"
    onload="this.onload=function(){};handleClientLoad()"
    onreadystatechange="if (this.readyState === 'complete') this.onload()">
</script>
