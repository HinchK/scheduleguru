<?php namespace ScheduleGuru\Calendar;


class CalendarRepository {


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

    function listAllCalendars(Google_Client &$client) {
        if (!isAuthenticated($client))
            return;

        $calList = createCalendar($client)->calendarList->listCalendarList();
        print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";
    }

    function getCalendarList($client) {
        return createCalendar($client)->calendarList->listCalendarList();
    }

    function getCalendar($client, $id) {
        return createCalendar($client)->calendars->get($id);
    }

    function getEventList($client, $calendarId) {
        return createCalendar($client)->events->listEvents(htmlspecialchars($calendarId));
    }

    function getEvent($client, $eventID) {
        return createCalendar($client)->events->listEvents(htmlspecialchars($calendarId));
    }

}