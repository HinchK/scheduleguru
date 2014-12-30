<?php namespace ScheduleGuru\Events;


class TutorSessionEventRepository {

    protected $packageStudentID;

    /**
     * @param $convertEvents
     * @return TutoringPackage
     */
    public function convertExistingEventsToPackage($convertEvents, $studentID)
    {
        TutoringPackage::unguard();
        $package = TutoringPackage::updateOrCreate(['student_id' => $studentID]);
        $pkgid = $package->id;

        foreach($convertEvents->events as $event)
        {

            \Debugbar::info('---DEBUGGIN----');
            \Debugbar::info($event);
            if(!is_string($event))
            {
                $tutoringEvent = new ScheduledTutorSession;
                $tutoringEvent->student_id  = $event->student_id;
                $tutoringEvent->gcal_event_id  = $event->gcal_event_id;
                $tutoringEvent->gcal_event_ical_id  = $event->gcal_event_ical_id;
                $tutoringEvent->gcal_event_etag  = $event->gcal_event_etag;
                $tutoringEvent->gcal_html_link  = $event->gcal_html_link;
                $tutoringEvent->session_type  = $event->session_type;
                $tutoringEvent->test_type  = $event->test_type;
                $tutoringEvent->tutor_id  = $event->tutor_unverified;
                $tutoringEvent->location  = $event->location;
                $tutoringEvent->package_id = $pkgid;

                $tutoringEvent->save();
            }
            //grab the last student id, we will update the package with it

        }

//        $package->student_id = $packageStudentID;
//        $package->push();

        $package->reguard();
        return $package;
    }


}