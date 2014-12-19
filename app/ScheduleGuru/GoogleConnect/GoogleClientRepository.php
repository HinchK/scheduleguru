<?php namespace ScheduleGuru\GoogleConnect;


use Debugbar;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Gmail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GoogleClientRepository
{

    /**
     * @return Google_Client
     */
    public function buildGoogleClient()
    {

        session_start();

        Debugbar::info('here we go, kickin off setupCalendarServices');

        $client_id = getenv('GOOG_CLIENT_ID');
        $client_secret = getenv('GOOG_CLIENT_SECRET');
        $dev_key = getenv('GOOG_DEV_KEY');
        $redirect_uri = 'http://localhost:8000/guru/google/calendars';
        /***********************************************
         * Testing with TokenData stuff
         * From: https://github.com/google/google-api-php-client   /
         * [blob/master/examples/idtoken.php]
         ************************************************/
        // $refreshToken = null;    //TODO: get refreshies working

        $client = new Google_Client();
        $client->setApplicationName("ScheduleGuru - TestPrepGuru Dashboard");
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->setDeveloperKey($dev_key);

        # Assuming scopes are already set?
        $client->setScopes(array(
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/calendar',
            'https://www.googleapis.com/auth/calendar.readonly',
            'https://mail.google.com/',
            'https://www.googleapis.com/auth/gmail.readonly',
            'https://www.googleapis.com/auth/gmail.modify',
            'https://www.googleapis.com/auth/gmail.compose',
        ));
        $client->setAccessType('offline');      # PERSITING IN LARAVEL'S SESSION-DB STYLE

        /************************************************
         * Boilerplate auth management
         ************************************************/
        $calsvc = new Google_Service_Calendar($client);
        $mailSvc = new Google_Service_Gmail($client);


        if (isset($_REQUEST['logout'])) {
            unset($_SESSION['access_token']);
        }
        if (isset($_GET['code'])) {
            Debugbar::info("_GET[code] is present]: ");
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
        }

        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);


        } else {
            $authUrl = $client->createAuthUrl();
            return Redirect::to($authUrl);
        }
        if ($client->getAccessToken()) {

            Debugbar::info('FINAL LEG, getting authToken');

            $_SESSION['access_token'] = $client->getAccessToken();
            Session::put('accessToken', $client->getAccessToken());
            Session::put('refreshToken', $client->getRefreshToken());
            $token_data = $client->verifyIdToken()->getAttributes();


            Debugbar::warning($client->getRefreshToken());
            Debugbar::warning("above me is the refresh tken");


            $calendarStuff = $calsvc->calendarList->listCalendarList();

            Debugbar::info('CalandarStuff: ');
            Debugbar::info($calendarStuff);

            $mailStuff = $mailSvc->users_messages->listUsersMessages('kasey.hinchman@gmail.com');
            Debugbar::info('MailStuff: ');
            Debugbar::info($mailStuff);

            Debugbar::warning('TOKEN_INFO: ');
            Debugbar::warning($token_data);

            return Redirect::to('guru/g/dashboard')->with('client_object', serialize($client));


        }


//        if(! $client->isAccessTokenExpired()){
//
//            Debugbar::warning('refreshing token!');
//            $newToken = $client->refreshToken(Session::get('refresh_token'));
//            $client->setAccessToken($newToken);
//
//        }
        if(Session::get('creds'))
        {
            Debugbar::warning(Session::get('creds'));
            Debugbar::info("debugging client authentication from getting 'cred' from session".$client->authenticate(Session::get('creds')));
        }
        return Redirect::to('/');

    }

}
