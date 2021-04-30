<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
class Google extends Model
{

    private $developer_key = "AIzaSyB4YivkSauKMid6EXKVdJap5_wNHCYLxQ4";

     /**
     * Get google client
     */
    public function getGoogleClient(){

        $credentialsPath = base_path().'\google_api_auth.json';

        $user = "fituska.mail@gmail.com";

        $client = new \Google_client();
        $client->setAuthConfig(base_path().'\fituska_service_acc.json');
        $client->setAccessType( 'offline' );
        $client->setApplicationName("FITuska");
        $client->setDeveloperKey($this->developer_key);
        $client->setRedirectUri( 'http://' . $_SERVER['HTTP_HOST'] . '/courses/import');
        $client->setScopes(\Google_Service_Calendar::CALENDAR);
        //$client->setSubject($user);

        // check if file with token access alreay exist
      /*  if ( file_exists( $credentialsPath ) ) {
            $accessToken = json_decode( file_get_contents( $credentialsPath ), true );
        }
        // if the file do not exist, generate new access token and save it to file
        else {
            $authUrl = $client->createAuthUrl();
            if ( ! isset( $_GET['code'] ) ) {
                header( "Location: $authUrl", true, 302 );
                exit;
            }

            $authCode = $_GET['code'];
            $accessToken = $client->fetchAccessTokenWithAuthCode( $authCode );

            if ( ! file_exists( dirname( $credentialsPath ) ) ) {
                mkdir( dirname( $credentialsPath ), 0700, true );
            }

            file_put_contents( $credentialsPath, json_encode( $accessToken ) );
        }

        $client->setAccessToken( $accessToken );

        if ( $client->isAccessTokenExpired() ) {
            $client->fetchAccessTokenWithRefreshToken( $client->getRefreshToken() );
            file_put_contents( $credentialsPath, json_encode( $client->getAccessToken() ) );
        }*/

        return $client;
    }



    /**
     * add user to google calendar
     * @param calendar_id calendar to which user wants to be added
     * @param user_email
     * @param service google calendar service
     */
    public function shareCalendarWithUser($calendar_id, $user_email, $service){
        $rule = new \Google_Service_Calendar_AclRule();
        $scope = new \Google_Service_Calendar_AclRuleScope();

        $scope->setType("user");
        $scope->setValue($user_email);
        $rule->setScope($scope);
        $rule->setRole("writer");

        $createdRule = $service->acl->insert($calendar_id, $rule);

        return true;
    }

    /**
     * Get list of events from given calendar
     * @param calendar_id
     */
    public function getEventsFromCalendar($calendar_id) {

        $client =  $this->getGoogleClient();
        $service = new \Google_Service_Calendar($client);


        $calendarId = $calendar_id;
        $optParams = array(
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => date('c'),
        );
        $results = $service->events->listEvents($calendarId, $optParams);
        $events = $results->getItems();

        return $events;
    }

    /**
     * Add new event to given calendar
     * @param calendar_id
     * @param summary title of event
     * @param desc description of event
     * @param date date of the event
     */
    public function addEvent($calendar_id, $summary, $desc, $date) {

        $dt = new DateTime($date);
        $date = $dt->format('Y-m-d\TH:i:s.').substr($dt->format('u'),0,3).'Z'; // convert to correct format for google api
        $client =  $this->getGoogleClient();
        $service = new \Google_Service_Calendar($client);

        $event = new \Google_Service_Calendar_Event(array(
            'summary' => $summary,
            'description' => $desc,
            'start' => array(
              'dateTime' => $date,
              'timeZone' => 'Europe/Prague',
            ),
            'end' => array(
              'dateTime' => $date,
              'timeZone' => 'Europe/Prague',
            ),
        ));

        $event = $service->events->insert($calendar_id, $event);

        return $event;
    }

}
