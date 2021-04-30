<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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


}
