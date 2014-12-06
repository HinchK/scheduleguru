<?php namespace ScheduleGuru\Tutors;

class Tutor extends \Eloquent {
	protected $fillable = [ 'email','calendarId','current_students',
        'past_students', 'freebusy','message_bag','photo','name',
        'notes','admin_notes','tutor_type','scheduledAppointments'];

    public function student()
    {
        return $this->belongsToMany('Student');
    }

    public function calendar()
    {
        return $this->hasOne('GoogleCalendar');
    }

    public function scheduledAppointment()
    {
        $this->hasManyThrough('ScheduledAppointment', 'Calendar', 'event_id', 'cal_id');
    }


}