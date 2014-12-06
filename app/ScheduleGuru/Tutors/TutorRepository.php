<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 11/30/2014
 * Time: 3:13 PM
 */

namespace ScheduleGuru\Tutors;


class TutorRepository {

    /**
     * @param $cal_id
     * @param $cal_summary
     * @internal param GoogleCalendar $calref
     * @return static
     */
    public static function buildTutorProfile($cal_id, $cal_summary)
    {
        $currentTutorList = Tutor::all();
        \Debugbar::info($currentTutorList);

        foreach($currentTutorList as $currentTutor){
            \Debugbar::info($currentTutor);
            if($currentTutor->calendarId === $cal_id){
                \Debugbar::info('tutor found in db');
                return false;
            }
        }

        $newTutor = Tutor::create(['calendarId' => $cal_id,'name' => $cal_summary]);
        \Debugbar::info("TUTREPO.buildTutorProfile|static \$newTutor: ");
        \Debugbar::info($newTutor);
        return $newTutor;
    }

} 