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