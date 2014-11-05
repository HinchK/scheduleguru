<?php namespace ScheduleGuru\GoogleConnect;

use Laracasts\Commander\CommandBus;

class GoogleClientSpawn implements CommandBus
{
    /**
     * Execute a command
     *
     * @param $command
     * @return mixed
     */
    public function execute($command)
    {
        \Debugbar::info('inside GoogleAuthCheck execution');

        session_start();
        $client = new Google_Client();
        // $client->setApplicationName('ScheduleGuru');         #  FOR SERVICE ACCOUNTS!!
        $client->setClientId(getenv('GOOG_CLIENT_ID'));
        $client->setClientSecret(getenv('GOOG_CLIENT_SECRET'));
        $client->setRedirectUri('http://localhost:8000/guru/google/calendars');
        # Assuming scopes are already set?
        $client->setScopes(array(
            'https://www.googleapis.com/auth/userinfo.email',
            'https://www.googleapis.com/auth/userinfo.profile',
            'https://www.googleapis.com/auth/plus.me',
            'https://www.googleapis.com/auth/calendar',
            'https://www.googleapis.com/auth/calendar.readonly'
        ));
        $client->setAccessType('offline');

        return $command->googleClient = $client;

    }
}