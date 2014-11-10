<?php namespace ScheduleGuru;

use ScheduleGuru\Calendar\GoogleCalendar;

class Student extends \Eloquent {
	protected $fillable = [];

    public function buildStudentProfile(GoogleCalendar $calref)
    {

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