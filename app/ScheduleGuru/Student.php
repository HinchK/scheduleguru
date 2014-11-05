<?php namespace ScheduleGuru;

class Student extends Eloquent {
	protected $fillable = [];

    public function mathTutor()
    {
        return $this->hasOne('MathTutor');
    }

    public function verbalTutor()
    {
        return $this->hasOne('VerbalTutor');
    }

    public function calendar()
    {
        return $this->hasOne('Calendar');
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