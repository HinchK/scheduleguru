<?php namespace ScheduleGuru;

class Student extends \Eloquent {
	protected $fillable = ['student_id', 'calendarId', 'name'];

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

        $studentId = trim(strtolower($cal_summary));
        $newStudent = Student::create(['student_id' => $studentId, 'calendarId' => $cal_id,'name' => $cal_summary]);
        return $newStudent;
    }

    public function mathTutor()
    {
        return $this->hasOne('MathTutor');
    }

    public function Tutor()
    {
        return $this->hasMany('Tutor');
    }

    public function verbalTutor()
    {
        return $this->hasOne('VerbalTutor');
    }

    public function calendar()
    {
        return $this->hasOne('GoogleCalendar');
    }

    public function mailMessages()
    {
        return $this->hasMany('MailMessage');
    }

    public function scheduledAppointment()
    {
        $this->hasManyThrough('ScheduledAppointment', 'Calendar', 'event_id', 'cal_id');
    }
}