<?php

use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use ScheduleGuru\Calendar\GoogleCalendarRepo;
use ScheduleGuru\GoogleConnect\GoogleToken;
use ScheduleGuru\GoogleProfile;

class GoogleAuthController extends BaseController {


    /**
     * @var
     */
    protected $gclient;
    /**
     * @param Google_Client $gclient
     * @internal param GoogleClientRepository $clientRepository
     * @internal param GoogleCalendarRepo $calendarRepo
     */
    function __construct(Google_Client $gclient)
    {
        $this->clientRepository = $gclient;
    }

    /**
     *
     */
    public function setupGoogleConnections()
    {
//        $googleConnector = new GoogleClientRepository();
//        View::share('authToken');
        return $this->clientRepository->buildGoogleClient();


//        return Redirect::home();

//        Debugbar::info($client);
//        $calservice = new Google_Service_Calendar($client);
        $calservice = new Google_Service_Oauth2_Userinfoplus($client);

    }

    public function redirectGoogleLogin()
    {
        return Redirect::to('/');
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function superUserGoogleLogin()
    {

        Debugbar::info("access_token superUserGoogL check:");
        Debugbar::info(Session::has('access_token'));
        if( Input::has('code') )
        {
            $code = Input::get('code');

            // authenticate with Google API
            if ( Googlavel::authenticate($code) )
            {
                $userProfile = Googlavel::getService('Oauth2');
                $googleProfile = $userProfile->userinfo->get();
                Session::put('userinfo', $googleProfile);
                Debugbar::info($googleProfile);
                return Redirect::route('google_welcome')->with('userinfo', $googleProfile);
//                return Redirect::route('dashboard_primary')->with('userinfo', $googleProfile);
            }
        }

        // get auth url
        $url = Googlavel::authUrl();

        return View::make('site.google.login')->with('url', $url);
        //turn link_to($url, 'Login with Google!');
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function welcome()
    {
        if(Session::has('userinfo')){

            $profileInfo = Session::get('userinfo');

            if($profileInfo->email === 'kasey.hinchman@gmail.com'){
                Auth::loginUsingId(1);
                Flash::overlay("Welcome! What will your first sequence of the day be?");


                $profileCheck = GoogleProfile::where('email',$profileInfo->email);
                $user_id = '1'; //logging in as admin

                if($profileCheck){
                    Debugbar::info('have google profile on record');
                    $profile = $profileCheck;
                    Debugbar::info($profile);
                }else{
                    $attributes['user_id'] = '1';
                    $profileRecord = new GoogleProfile($attributes);
                    $profile = $this->applyObjectDetailsToProfileRecordModel($profileInfo, $profileRecord, 'google_id');
                    $profile->save();
                }
                $authToken = $this->tokenStorage($user_id, $profileInfo->id);
                $authToken->save();

            }else{
                Auth::loginUsingId(2);
                Flash::success("Welcome! Not sure who you are gettin' all fancy with google, so I'll call you user");
            }

            return View::make('site.google.welcome')->with('userinfo', $profileInfo);
        }else{
            return Redirect::to("/");
        }

    }

    /**
     * Store the token data in the db.
     * Token must be in json_encoded form when used by Google
     * @param $user_id
     * @param $google_id
     * @return mixed
     */
    protected function tokenStorage($user_id, $google_id)
    {
        $storage =  new GoogleToken;
        $storage->user_id = $user_id;
        $storage->google_id = $google_id;

        $session_access_token = Session::get('access_token');
        $data = json_decode($session_access_token);
        Debugbar::info($data);
        $created = Carbon::createFromTimestamp($data->created);
        Debugbar::info($created);
        $expiretime = Carbon::createFromTimestamp($data->created + $data->expires_in);
        Debugbar::info($expiretime);

        $data->created = $created;
        $data->expires_in = $expiretime;

        Session::put('raw_access_token',$data->access_token);
        Session::put('expires_utc',$expiretime);
        $tokenstore = $this->applyObjectDetailsToProfileRecordModel($data, $storage);
        return $tokenstore;
    }

    /**
     * @param $profileInfo
     * @param $profileRecord
     * @param null $shift_id_column
     * @return mixed
     */
    protected function applyObjectDetailsToProfileRecordModel($profileInfo, $profileRecord, $shift_id_column = null) {
        $attributes = get_object_vars($profileInfo);
        if($shift_id_column){
            $attributes[$shift_id_column] = $attributes['id'];  //moving google's id to the DB's reference
            unset($attributes['id']);
        }
        Debugbar::info($attributes);
        foreach ($attributes as $k=>$v) {
            $profileRecord->$k = $v;
        }
        return $profileRecord;
    }

    public function dashboardSetup()
    {
        // Get the google service (related scope must be set)
        $service = Googlavel::getService('Calendar');

        // invoke API call
        $calendarList = $service->calendarList->listCalendarList();

        foreach ( $calendarList as $calendar )
        {
            echo "{$calendar->summary} <br>";
        }

        echo "<br><---------------------------------------------><br><br>";
        $gmailService = Googlavel::getService('Gmail');


        $gmailThreadList = $gmailService->users_threads->listUsersThreads('me');

        foreach ( $gmailThreadList as $thread )
        {
            print 'Thread with ID: ' . $thread->getId() . '<br/>';
            $getThread = $gmailService->users_threads->get('me', $thread->getId());
            $messages = $getThread->getMessages();
            $msgCount = count($messages);
            echo "#messages in thread: {$msgCount} <br>";
            foreach ($messages as $message)
            {
                echo "     ".print_r($message->id)." |0-0| ".print_r($message->snippet);
            }
//        $thread_str = serialize($thread);
//        echo "Thread: {$thread_str}";
        }

        link_to('google/logout', 'Logout');

        View::make('site.google.dashboard');
    }

    public function authenticate()
    {
        session_start();
        Debugbar::info('here we go, kickin off setupCalendarServices');

        $client_id = getenv('GOOG_CLIENT_ID');
        $client_secret = getenv('GOOG_CLIENT_SECRET');
        $dev_key = getenv('GOOG_DEV_KEY');
        $redirect_uri = 'http://localhost:8000/guru/google/calendars';
        /***********************************************
        Testing with TokenData stuff
        From: https://github.com/google/google-api-php-client   /
        [blob/master/examples/idtoken.php]
        ************************************************/

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
            'https://www.googleapis.com/auth/drive',
            'https://mail.google.com/',
            'https://www.googleapis.com/auth/gmail.readonly',
            'https://www.googleapis.com/auth/gmail.modify',
            'https://www.googleapis.com/auth/gmail.compose',
        ));

        $client->setAccessType('offline');      # PERSITING IN LARAVE

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
            return Redirect::to($authUrl);

        }

        /************************************************
        If we're signed in we can go ahead and retrieve
        the ID token, which is part of the bundle of
        data that is exchange in the authenticate step
        - we only need to do a network call if we have
        to retrieve the Google certificate to verify it,
        and that can be cached.
         ************************************************/
        if ($client->getAccessToken()) {
            $_SESSION['access_token'] = $client->getAccessToken();
            $token_data = $client->verifyIdToken()->getAttributes();
        }

        if (isset($token_data)){
            dd($token_data);
        }
    }

    /**
     *
     */
    public function logout(){
        // perform a logout with redirect
        Confide::logout();
        Flash::success('You have been logged out.');
        return Googlavel::logout('/');
    }

}