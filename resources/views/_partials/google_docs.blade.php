<h2 class="mt-25">Sdílené dokumenty</h2>

<button id="authorize_button" style="display: none;" class="btn btn-secondary">Autorizovat</button>
<button id="signout_button" style="display: none;" class="btn btn-secondary">Odhlásit</button>
<div class="row">
    <div class="col-10">
        <div class="course-posts">
            <div class="row course-post-header-compact">
                <div class="col-4">
                    <span class="posts-header">Název souboru</span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="posts-header">Typ</span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="posts-header">Datum vložení</span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="posts-header">Autor</span>
                </div>
            </div>
            <pre id="content"></pre>

            <div class="row course-post-compact">
                <div class="col-4">
                    <a href="" target="_blank"></a>
                </div>
                <div class="col-2" style="text-align:center">
                    <span class="normal"></span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span></span>
                </div>
                <div class="col-2" style="text-align:center">
                    <span><a href=""></a></span>

                </div>
            </div>
        </div>
    </div>
</div>








<script type="text/javascript">
    // Client ID and API key from the Developer Console
    var CLIENT_ID = '923025024916-8m1fat5k5g2puvo5vlfkinahhme341eg.apps.googleusercontent.com';
    var API_KEY = 'AIzaSyAgSNCOWIH9pOcLzMN8UtITD58KunSFpxE';

    // Array of API discovery doc URLs for APIs used by the quickstart
    var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/drive/v3/rest"];

    // Authorization scopes required by the API; multiple scopes can be
    // included, separated by spaces.
    var SCOPES = 'https://www.googleapis.com/auth/drive.metadata';

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
      var pre = document.getElementById('content');
      var textContent = document.createTextNode(message + '\n');
      pre.appendChild(textContent);
    }

    /**
     * Print files.
     */
    function listFiles() {
      gapi.client.drive.files.list({
        'pageSize': 10,
        'fields': "nextPageToken, files(id, name)"
      }).then(function(response) {
        appendPre('Files:');
        var files = response.result.files;
        if (files && files.length > 0) {
          for (var i = 0; i < files.length; i++) {
            var file = files[i];
            appendPre(file.name + ' (' + file.id + ')');
          }
        } else {
          appendPre('No files found.');
        }
      });
    }

  </script>

  <script async defer src="https://apis.google.com/js/api.js"
    onload="this.onload=function(){};handleClientLoad()"
    onreadystatechange="if (this.readyState === 'complete') this.onload()">
  </script>
