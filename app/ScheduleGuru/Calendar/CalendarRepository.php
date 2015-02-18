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
     * Build array of google Calendars
     * that have no association within the application
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

    /**
     * based on TPG's calendar-summary naming conventions
     * created panels for batching student/tutor/etc sorting operations
     * based on the presence of the '*' identifier
     *
     * returns 3 arrays in one [students, tutors, TAs]
     *
     * @param $googleCals
     * @return array
     */
    public function summaryHintAnalysis($googleCals)
    {
        $possibleStudents = [];
        $possibleTutors = [];
        $possibleTAs = [];

        $stkey = 0;
        $tukey = 0;
        $takey = 0;

        foreach($googleCals as $cal)
        {
            $tpg_employee_identifier = "*";
            $tpg_ta_identifier = "*(";
            $summary = $cal['summary'];
            $tpg_check = strpos($summary, $tpg_employee_identifier);
            $ta_check = strpos($summary, $tpg_ta_identifier);

            if ($tpg_check === false)   //if no "*", might be a student
            {
                $possibleStudents[$stkey] = $cal;
                $stkey++;
            }elseif ($ta_check !== false)  //looking for "*(TA)"
            {
                $possibleTAs[$takey] = $cal;
                $takey++;
            }elseif ($tpg_check !== false && $ta_check === false)
            {
                $possibleTutors[$tukey] = $cal;
                $tukey++;
            }

        }
        return [$possibleStudents, $possibleTutors, $possibleTAs];
    }
}
