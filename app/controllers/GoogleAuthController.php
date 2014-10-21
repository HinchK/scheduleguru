<?php

use AdamWathan\EloquentOAuth\Facades\OAuth;
use ScheduleGuru\Calendar\CalendarRepository;
use ScheduleGuru\Calendar\GoogleCalendarRepo;

class GoogleAuthController extends \BaseController {


    /**
     * @var
     */
    protected $calendarRepo;

    /**
     * @param GoogleCalendarRepo $calendarRepo
     */
    function __construct(CalendarRepository $calendarRepo)
    {
        $this->calendarRepo = $calendarRepo;
    }

    /**
     *
     */
    public function setupCalendarServices()
    {
        session_start();

        Debugbar::info('here we go, kickin off setupCalendarServices');


        $client_id = getenv('GOOG_CLIENT_ID');
        $client_secret = getenv('GOOG_CLIENT_SECRET');
        $redirect_uri = 'http://localhost:8000/guru/google/calendars';

        $client = new Google_Client();
        // $client->setApplicationName('ScheduleGuru');         #  FOR SERVICE ACCOUNTS!!
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        # Assuming scopes are already set?
        $client->setScopes(array(
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/calendar',
            'https://www.googleapis.com/auth/calendar.readonly'
        ));
        $client->setAccessType('offline');      # PERSITING IN LARAVEL'S SESSION-DB STYLE

        Debugbar::info('sup with this _token in out Session?: ');

//        $sessData = Session::all();
  //      Debugbar::info($sessData);

        $calservice = new Google_Service_Calendar($client);     

		/************************************************
		  If we're logging out we just need to clear our
		  local access token in this case
		 ************************************************/
		if (isset($_REQUEST['logout'])) {
		  unset($_SESSION['access_token']);
		}

		/************************************************
		  If we have a code back from the OAuth 2.0 flow,
		  we need to exchange that with the authenticate()
		  function. We store the resultant access token
		  bundle in the session, and redirect to ourself.
		 ************************************************/
		if (isset($_GET['code'])) {
		  $client->authenticate($_GET['code']);
		  $_SESSION['access_token'] = $client->getAccessToken();
		  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		}

		/************************************************
		  If we have an access token, we can make
		  requests, else we generate an authentication URL.
		 ************************************************/
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		  $client->setAccessToken($_SESSION['access_token']);
		} else {
		  $authUrl = $client->createAuthUrl();
		  return $authUrl;
		  //TODO:KDOGG
		}


        $calendarList = $calservice->calendarList->listCalendarList();
        print_r($calendarList);

        while(true) {
            foreach ($calendarList->getItems() as $calendarListEntry) {
                Debugbar::info($calendarListEntry->getSummary());
                echo $calendarListEntry->getSummary();
            }
            $pageToken = $calendarList->getNextPageToken();
            if ($pageToken) {
                DebugBar::warning('Got a page token here!');
                $optParams = array('pageToken' => $pageToken);
                $calendarList = $calservice->calendarList->listCalendarList($optParams);
                Debugbar::info($calendarList);
            } else {
                break;
            }
        }
    }

    /**
     * Google Auth Login
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginWithGoogle() {

        // get data from input
        $code = Input::get( 'code' );

        // get google service
        $googleService = OAuth::consumer( 'Google' );

        // check if code is valid

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken( $code );

            // Send a request with it
            $result = json_decode( $googleService->request( 'https://www.googleapis.com/oauth2/v1/userinfo' ), true );

            $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            echo $message. "<br/>";

            //Var_dump
            //display whole array().
            dd($result);

        }
        // if not ask for permission first
        else {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to google login url
            return Redirect::to( (string)$url );
        }
    }



}