<?php namespace ScheduleGuru\GoogleConnect;


class GoogleClientRepository {

    function authenticate(&$client) {
        if (isset($_GET['logout'])) {
            unset($_SESSION['token']);
        }

        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['token'] = $client->getAccessToken();
            header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        }

        if (isset($_SESSION['token'])) {
            $client->setAccessToken($_SESSION['token']);
        }

        return isAuthenticated($client);
    }

    function createCalendar(&$client) {
        return new Google_CalendarService($client);
    }

    function isAuthenticated(Google_Client &$client) {
        createCalendar($client);
        if ($client->getAccessToken()) {
            $_SESSION['token'] = $client->getAccessToken();
            return true;
        }

        $authUrl = $client->createAuthUrl();
        print "<a class='login' href='$authUrl'>Connect Me!</a>";
    }








}