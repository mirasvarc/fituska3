
<script type="text/javascript">

    moment.locale('cs');

    function addCalEvent(){

        var eventName = $('#EventName').val();
        var eventDesc = $('#EventDesc').val();
        var eventDate = $('#EventDate').val();
        console.log(moment(eventDate).format())
        console.log(eventName)
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
            'calendarId': $('#course-name').val(),
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

            if($('#course-name').val() == "primary" && $('#course-name').val() != undefined) {
                var code = $('.course-h1').attr('id');
                if($('.course-h1').attr('id') !== undefined) {
                    var req = gapi.client.calendar.calendars.insert({
                        "resource": {
                            "summary": code,
                            "description": "calendar",
                            "timezone": "Europe/Prague"}
                    }).then(function(response) {
                        console.log(response.result.id)
                        $('#course-name').val(response.result.id);
                        updateCalId(code, response.result.id);
                        listUpcomingEvents();
                    });
                }

            } else {
                listUpcomingEvents();
            }


        }, function(error) {
            appendPre(JSON.stringify(error, null, 2));
        });
    }

    function updateCalId(course, calendar_id) {

        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ url('/course/calendar/update')}}",
                method: 'post',
                data: {'code':course, 'calendar_id': calendar_id},
                success: function(response){
                    console.log(response);
                }
            });

        });

    }


    /**
    *  Called when the signed in status changes, to update the UI
    *  appropriately. After a sign-in, the API is called.
    */
    function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
            authorizeButton.style.display = 'none';
            //signoutButton.style.display = 'block';
            listFiles();
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
            'calendarId': $('#course-name').val(),
            'timeMin': (new Date()).toISOString(),
            'showDeleted': false,
            'singleEvents': true,
            'maxResults': 10,
            'orderBy': 'startTime'
        }).then(function(response) {
            var events = response.result.items;
            console.log(response)
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

    // Client ID and API key from the Developer Console
    var CLIENT_ID_DRIVE = '923025024916-8m1fat5k5g2puvo5vlfkinahhme341eg.apps.googleusercontent.com';
    var API_KEY_DRIVE = 'AIzaSyAgSNCOWIH9pOcLzMN8UtITD58KunSFpxE';

    // Array of API discovery doc URLs for APIs used by the quickstart
    var DISCOVERY_DOCS_DRIVE = ["https://www.googleapis.com/discovery/v1/apis/drive/v3/rest"];

    // Authorization scopes required by the API; multiple scopes can be
    // included, separated by spaces.
    var SCOPES_DRIVE = 'https://www.googleapis.com/auth/drive';


    function createSharedFile(){

        var code = $('.course-h1').attr('id');
        var folder_id = "";
        gapi.client.drive.files.list({
            'pageSize': 10,
            'fields': "nextPageToken, files(id, name)",
            'q': "mimeType='application/vnd.google-apps.folder'",
            'q': "name='"+code+"'"
        }).then(function(response) {
            var files = response.result.files;

            if (files && files.length > 0) {

                console.log(files[0].id)
                folder_id = files[0].id;

                console.log($('input[name=shared_file_name]').val());
                var fileName = $('input[name=shared_file_name]').val();
                var fileMetadata = {
                    'name' : fileName,
                    'mimeType' : 'application/vnd.google-apps.document',
                    'parents' : [folder_id]
                };

                gapi.client.drive.files.create({
                    resource: fileMetadata,
                }).execute();
            }
        });
    }

    /**
     *  On load, called to load the auth2 library and API client library.
     */
    function handleDriveClientLoad() {
      gapi.load('client:auth2', initDriveClient);
    }

    /**
     *  Initializes the API client library and sets up sign-in state
     *  listeners.
     */
    function initDriveClient() {

      gapi.client.init({
        apiKey: API_KEY_DRIVE,
        clientId: CLIENT_ID_DRIVE,
        discoveryDocs: DISCOVERY_DOCS_DRIVE,
        scope: SCOPES_DRIVE
      }).then(function () {

        // Listen for sign-in state changes.
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

        // Handle the initial sign-in state.
        updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
        authorizeButton.onclick = handleAuthClick;
        signoutButton.onclick = handleSignoutClick;
      }, function(error) {
        appendDrivePre(JSON.stringify(error, null, 2));
      });
    }

    /**
     * Append a pre element to the body containing the given message
     * as its text node. Used to display the results of the API call.
     *
     * @param {string} message Text to be placed in pre element.
     */
    function appendDrivePre(message) {
        var pre = $('#shared-files');

        if(message.id) {
            pre.append('<div class="row course-post-compact">' +
                    '<div class="col-4"><span>' + message.name + '</span>' +
                    '</div><div class="col-2" style="text-align:center"> ' +
                    '<a href="https://docs.google.com/document/d/' + message.id + ' " target="_blank">Otevřít</a>' +
                    '<span class="normal"></span></div><div class="col-2" style="text-align:center"> ' +
                    '<span></span></div><div class="col-2" style="text-align:center"><span><a href=""></a>' +
                    '</span></div></div>');
        } else {
            pre.append('<div class="row course-post-compact">' +
                    '<div class="col-4"><span>Žádný soubor nenalezen</span>' +
                    '</div><div class="col-2" style="text-align:center"> ' +
                    '<span class="normal"></span></div><div class="col-2" style="text-align:center"> ' +
                    '<span></span></div><div class="col-2" style="text-align:center"><span><a href=""></a>' +
                    '</span></div></div>');
        }
    }

    /**
     * Print files.
     */
    function listFiles() {

        var code = $('.course-h1').attr('id');
        var folder_id = "";
        gapi.client.drive.files.list({
            'pageSize': 10,
            'fields': "nextPageToken, files(id, name)",
            'q': "mimeType='application/vnd.google-apps.folder'",
            'q': "name='"+code+"'"
        }).then(function(response) {
            var files = response.result.files;
            if (files && files.length > 0) {

                console.log(files[0].id)
                folder_id = files[0].id;

                gapi.client.drive.files.list({
                    'pageSize': 10,
                    'fields': "nextPageToken, files(id, name)",
                    'q':"'"+folder_id+"' in  parents"
                }).then(function(response) {
                    console.log(response)
                    var files = response.result.files;
                    if (files && files.length > 0) {
                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];
                            console.log("test")
                            appendDrivePre(file);
                        }
                    } else {
                        appendDrivePre('No files found.');
                    }
                });
            } else {
                console.log("Folder does not exist")
                if(code != null) {
                    var fileMetadata = {
                        'name' : code,
                        'mimeType' : 'application/vnd.google-apps.folder',
                    };

                    gapi.client.drive.files.create({
                        resource: fileMetadata,
                    }).execute();
                }

            }
        });

    }

  </script>

  <script async defer src="https://apis.google.com/js/api.js"
    onload="this.onload=function(){};handleClientLoad();handleDriveClientLoad()"
    onreadystatechange="if (this.readyState === 'complete') this.onload()">
  </script>
