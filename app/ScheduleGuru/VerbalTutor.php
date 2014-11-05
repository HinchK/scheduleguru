<?php

class VerbalTutor extends \Eloquent {
	protected $fillable = [];

    public function student()
    {
        return $this->belongsToMany('Student');
    }

    public function calendar()
    {
        return $this->hasOne('Calendar');
    }

    public function scheduledAppointment()
    {
        $this->hasManyThrough('ScheduledAppointment', 'Calendar', 'event_id', 'cal_id');
    }

    public function mailMessages()
    {
        return $this->hasMany('MailMessage');
    }
}