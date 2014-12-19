<?php namespace ScheduleGuru\Students;


use Illuminate\Support\Str;
use ScheduleGuru\Student;

class StudentRepository {

    public  function buildEventSessionConversionArray($events, $student)
    {
        $tutoringPackageEvents =  $this->buildTutoringPackageEvents($events);

        $scheduledSessions = [];
        $key = 0;

        foreach($tutoringPackageEvents as $tpgevent){
            $start  = strpos($tpgevent['summary'], '[');
            $end    = strpos($tpgevent['summary'], ']', $start + 1);
            $length = $end - $start;
            $location = substr($tpgevent['summary'], $start + 1, $length - 1);

            if(strpos($tpgevent['summary'], 'SAT') !== false){
                $testType = 'SAT';
            }elseif(strpos($tpgevent['summary'], 'ACT') !== false){
                $testType = 'ACT';
            }else{
                $testType = '-----';
            }
            if(strpos($tpgevent['summary'], 'Math') !== false){
                $sessionType = 'Math';
            }elseif(strpos($tpgevent['summary'], 'Verbal') !== false){
                $sessionType = 'Verbal';
            }elseif(strpos($tpgevent['summary'], 'Practice test') !== false){
                $sessionType = 'EXAM';
            }else{
                $sessionType = 'unknown';
            }
            $summaryArray = explode(',', $tpgevent['summary']);
            $tutorName = trim(current(explode('[', array_pop($summaryArray))));
            $scheduledSessions[$key]['location'] = $location;
            $scheduledSessions[$key]['test_type'] = $testType;
            $scheduledSessions[$key]['session_type'] = $sessionType;
            $scheduledSessions[$key]['gcal_event_id'] = $tpgevent['id'];
            $scheduledSessions[$key]['gcal_event_ical_id'] = $tpgevent['iCalUID'];
            $scheduledSessions[$key]['gcal_event_etag'] = $tpgevent['etag'];
            $scheduledSessions[$key]['gcal_html_link'] = $tpgevent['htmlLink'];
            $scheduledSessions[$key]['gcal_status'] = $tpgevent['status'];
            $scheduledSessions[$key]['start_time'] = $tpgevent['startTime'];
            $scheduledSessions[$key]['end_time'] = $tpgevent['endTime'];
            $scheduledSessions[$key]['student_id'] = $student->id;
            $scheduledSessions[$key]['tutor_unverified'] = $tutorName;
            $scheduledSessions[$key]['summary_raw'] = $tpgevent['summary'];

            $key++;
        }
        return $scheduledSessions;
    }

    public function  buildTutoringPackageEvents($events)
    {
        $tutoringPackage = [];
        $key = 0;

        foreach($events as $event)
        {
            if($event->status != "cancelled")
            {
                $tutoringPackage[$key] = get_object_vars($event);
                if($event->creator->displayName)
                {
                    $tutoringPackage[$key]['startTime'] = $event->start->dateTime;
                    $tutoringPackage[$key]['endTime'] = $event->end->dateTime;
                    $tutoringPackage[$key]['creatorName'] = $event->creator->displayName;
                    $tutoringPackage[$key]['creatorEmail'] = $event->creator->email;
                    $tutoringPackage[$key]['organizerName'] = $event->organizer->displayName;
                    $tutoringPackage[$key]['organizerEmail'] = $event->organizer->email;
                    $tutoringPackage[$key]['remindersDefault'] = $event->reminders->useDefault;
                }
                if($event->originalStartTime)
                {
                    $tutoringPackage[$key]['originalStart'] = $event->originalStartTime->dateTime;
                }
                $key++;
            }
        }
        return $tutoringPackage;
    }
    /**
     * @param $cal_id
     * @param $cal_summary
     * @return static
     */
    public static function buildStudentProfile($cal_id, $cal_summary)
    {
        $currentStudentList = Student::all();
        \Debugbar::info($currentStudentList);

        foreach($currentStudentList as $currentStudent){
            \Debugbar::info($currentStudent);
            if($currentStudent->calendarId === $cal_id){
                \Debugbar::info('student found in db');
                return false;
            }
        }

        $studentIdmaker = explode('@', str_replace('.', ' ', trim(strtolower($cal_summary))));
        //\Debugbar::info('student id/slug stuff');
        //\Debugbar::info($studentIdmaker);
        if(is_array($studentIdmaker)){
            $studentId = $studentIdmaker[0];
        }else{
            $studentId = $studentIdmaker;
        }
        $slug = Str::slug($studentId);

        $newStudent = Student::create(['student_id' => $studentId, 'calendarId' => $cal_id,'name' => $cal_summary, 'slug' => $slug]);
        \Debugbar::info($newStudent);

        return $newStudent;
    }
} 