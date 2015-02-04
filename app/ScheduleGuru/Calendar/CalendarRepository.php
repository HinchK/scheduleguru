<?php namespace ScheduleGuru\Calendar;


use Googlavel;
use Google_Auth_Exception;

class CalendarRepository {

    /**
     * ..: method-hints with google services :..
     *
     * $cal = new \Google_Service_Calendar($client);
     * $cal->calendarList->listCalendarList()
     */

    /**
     * @param $cal_id
     * @param null $fetchAfterDate
     * @return mixed
     */
    public static function fetchEvents($cal_id, $fetchAfterDate = null)
    {
        try {
            $eventObjects = Googlavel::getService('Calendar')->events->listEvents($cal_id)->getItems();
        }catch (Google_Auth_Exception $e){
            return false;
        }
        \Debugbar::info("Let's use this \$fetchAfterDate");
        \Debugbar::info($fetchAfterDate);
        return $eventObjects;
    }

    /**
     * Build array of Calendars without an Association
     * (student, tutor, etc)
     *
     * @return array|bool
     */
    public function buildPrimaryCalendarList(){
        $service = Googlavel::getService('Calendar');
        try {
            $calendarList = $service->calendarList->listCalendarList();
        }catch (Google_Auth_Exception $e){
            return false;
        }
        $knownCalendars = GoogleCalendar::all();
        $calarray = [];

        $key = 0;
        foreach($calendarList as $cal)
        {
            $checkcal = get_object_vars($cal);
            array_push($calarray, $checkcal);
            $calarray[$key] = $checkcal;
            foreach($knownCalendars as $knownCals){
                if($cal->id === $knownCals->cal_id) {
                    unset($calarray[$key]);
                }
            }
            $key++;
        }
        return array_values($calarray);
    }
}
