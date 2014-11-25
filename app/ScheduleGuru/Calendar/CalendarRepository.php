<?php namespace ScheduleGuru\Calendar;


use Googlavel;
use ScheduleGuru\Tutor;

class CalendarRepository {


    //helpful way to enact method-hints
    //$cal = new \Google_Service_Calendar($client);
    //$cal->calendarList->listCalendarList()


    function buildPrimaryCalendarList(){
        $service = Googlavel::getService('Calendar');
        $calendarList = $service->calendarList->listCalendarList();

        $knownCalendars = GoogleCalendar::all();
//        \Debugbar::info($calendarList);
        \Debugbar::info('begin filtering of cal lists');

        $calarray = [];

        $key = 0;
        foreach($calendarList as $cal)
        {
            $checkcal = get_object_vars($cal);
            array_push($calarray, $checkcal);
            $calarray[$key] = $checkcal;
            foreach($knownCalendars as $knownCals){
                if($cal->id === $knownCals->cal_id) {
//                    \Debugbar::info('we have a match here in calendar repo, removing!');
//                    \Debugbar::info($cal->summary);
                    unset($calarray[$key]);
                }
//                }else{
//                    \Debugbar::info('not a match print to view');
//                    \Debugbar::info($cal->summary);
//                }

            }
            $key++;
        }
//        dd(array_values($calarray));
        return array_values($calarray);
//        return $calendarList;
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
        return createCalendar($client)->events->listEvents(htmlspecialchars($eventID));
    }

    // ---------------------------------------------------------
// ----- object_to_array_recusive --- function (PHP) ------
// --------------------------------------------------------
// -- arg1:  $object  =  (PHP Object with Children)
// -- arg2:  $assoc   =  (TRUE / FALSE) - optional
// -- arg3:  $empty   =  ('' or NULL) - optional
// --------------------------------------------------------
// ----- return: Array from Object --- (associative) ------
// --------------------------------------------------------

    function object_to_array_recusive ( $object, $assoc=1, $empty='' )
    {
        $out_arr = array();
        $assoc = (!empty($assoc)) ? TRUE : FALSE;

        if (!empty($object)) {

            $arrObj = is_object($object) ? get_object_vars($object) : $object;

            $i=0;
            foreach ($arrObj as $key => $val) {
                // $key changed from $akey....
                $key = ($assoc !== FALSE) ? $key : $i;
                if (is_array($val) || is_object($val)) {
                    $out_arr[$key] = (empty($val)) ? $empty : object_to_array_recusive($val);
                }
                else {
                    $out_arr[$key] = (empty($val)) ? $empty : (string)$val;
                }
                $i++;
            }

        }

        return $out_arr;
    }

// --------------------------------------------------------
// --------------------------------------------------------


}