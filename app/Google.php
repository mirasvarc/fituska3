<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use App\Calendar;
class Google extends Model
{

    private $developer_key = "AIzaSyB4YivkSauKMid6EXKVdJap5_wNHCYLxQ4";

     /**
     * Get google client
     */
    public function getGoogleClient(){

        $client = new \Google_client();
        $client->setAuthConfig(base_path().'\fituska_service_acc.json');
        $client->setAccessType( 'offline' );
        $client->setApplicationName("FITuska");
        $client->setDeveloperKey($this->developer_key);
        $client->setRedirectUri( 'http://' . $_SERVER['HTTP_HOST'] . '/courses/import');
        $client->setScopes([\Google_Service_Calendar::CALENDAR, \Google_Service_Drive::DRIVE]);

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
    public function getEventsFromCalendar($calendar_id, $course) {

        $client =  $this->getGoogleClient();
        $service = new \Google_Service_Calendar($client);

        if($calendar_id == null && $course != null) {
            $calendar_id = $this->createCalendarForCourse($course);
        }


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

        $client =  $this->getGoogleClient();
        $service = new \Google_Service_Calendar($client);

        $event = new \Google_Service_Calendar_Event(array(
            'summary' => $summary,
            'description' => $desc,
            'start' => array(
              'dateTime' => date_format(date_create($date), 'c'),
              'timeZone' => 'Europe/Prague',
            ),
            'end' => array(
              'dateTime' => date_format(date_create($date), 'c'),
              'timeZone' => 'Europe/Prague',
            ),
        ));
        $event = $service->events->insert($calendar_id, $event);

        return $event;
    }


    /**
     * Create Google calendar for given course
     * @param course course code¨
     * @return Google_Service_Calendar created calendar
     */
    public function createCalendarForCourse($course) {

        $client =  $this->getGoogleClient();

        $service = new \Google_Service_Calendar($client);

        $calendar = new \Google_Service_Calendar_Calendar();
        $calendar->setSummary($course);
        $calendar->setTimeZone('Europe/Prague');

        $createdCalendar = $service->calendars->insert($calendar);

        $this->shareCalendarWithUser($createdCalendar->getId(), "fituska.mail@gmail.com" , $service);

        $db_cal = new Calendar();
        $db_cal->calendar_id = $createdCalendar->getId();
        $db_cal->save();

        $course = Course::where('code', $course)->first();
        $course->calendar_id = $createdCalendar->getId();
        $course->save();

        return $createdCalendar->getId();
    }

    /**
     * Create folder on Google drive for given course
     * @param course course code
     * @return Google_Service_Drive_DriveFile created folder
     */
    public function createDriveFolderForCourse($course) {

        $client =  $this->getGoogleClient();
        $service = new \Google_Service_Drive($client);

        $file = new \Google_Service_Drive_DriveFile();
        $file->setName($course);
        $file->setMimeType('application/vnd.google-apps.folder');

        $folder = $service->files->create($file);

        return $folder;
    }

    /**
     * Get all files from Google drive folder for given course
     * @param course course code
     * @return Google_Service_Drive_DriveFile files
     */
    public function getSharedFilesForCourse($course) {

        $client =  $this->getGoogleClient();
        $service = new \Google_Service_Drive($client);

        $optParams = array(
            'pageSize' => 10,
            'fields' => 'nextPageToken, files(id, name)',
            'q' => "mimeType = 'application/vnd.google-apps.folder' and name contains '".$course."'"
        );

        $results = $service->files->listFiles($optParams);

        if (count($results->getFiles()) == 0) {
            $new_folder = $this->createDriveFolderForCourse($course); // if folder does not exist, create it
        } else {
            $files = $this->getFilesFromFolder($results[0]->getId());
            return $files;
        }

        return $this->getFilesFromFolder($new_folder->getId());

    }

    /**
     * Get files from given Google drive folder ID
     * @param folder_id folder id
     * @return Google_Service_Drive_DriveFile files
     */
    public function getFilesFromFolder($folder_id) {
        $client =  $this->getGoogleClient();
        $service = new \Google_Service_Drive($client);

        $optParams = array(
            'pageSize' => 10,
            'fields' => 'nextPageToken, files(id, name)',
            'q' => "'".$folder_id."' in  parents"
        );

        $results = $service->files->listFiles($optParams);

        return $results->getFiles();
    }

    /**
     * Get Google drive folder for given course
     * @param course course code
     * @return id folder id
     */
    public function getSharedFolderIdByCourse($course){
        $client =  $this->getGoogleClient();
        $service = new \Google_Service_Drive($client);

        $optParams = array(
            'pageSize' => 10,
            'fields' => 'nextPageToken, files(id, name)',
            'q' => "mimeType = 'application/vnd.google-apps.folder' and name contains '".$course."'"
        );

        $results = $service->files->listFiles($optParams);

        return $results[0]->getId();
    }

    /**
     * Create new shared file in Google drive folder for given course
     * @param course course code
     * @param file_name name of the file
     * @return Google_Service_Drive_DriveFile created file
     */
    public function createSharedFile($course, $file_name) {

        $folder_id[] = $this->getSharedFolderIdByCourse($course);

        $client =  $this->getGoogleClient();
        $service = new \Google_Service_Drive($client);

        $file = new \Google_Service_Drive_DriveFile();
        $file->setName($file_name);
        $file->setParents($folder_id);
        $file->setMimeType('application/vnd.google-apps.document');


        $file = $service->files->create($file);

        // add writer permission for everyone
        $permissionService = new \Google_Service_Drive_Permission();
        $permissionService->role = "writer";
        $permissionService->type = "anyone";
        $service->permissions->create($file->getId(), $permissionService);

        return $file;
    }

    /**
     * Get student scriptum file form Google drive folder for given course
     * @param course course code
     * @return Google_Service_Drive_DriveFile scriptum file
     */
    public function getStudentScriptumForCourse($course) {

        $folder_id = $this->getSharedFolderIdByCourse($course);

        $client =  $this->getGoogleClient();
        $service = new \Google_Service_Drive($client);

        $optParams = array(
            'pageSize' => 10,
            'fields' => 'nextPageToken, files(id, name)',
            'q' => "'".$folder_id."' in  parents and name contains 'Skripta'"
        );

        $results = $service->files->listFiles($optParams);

        $files = $results->getFiles();

        if (count($results->getFiles()) == 0) {
            $file = $this->createSharedFile($course, "Skripta"); // if scriptum does not exist, create it
        } else {
            return $files[0];
        }

        return $file;
    }


}
