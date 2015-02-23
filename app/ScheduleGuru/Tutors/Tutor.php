<?php namespace ScheduleGuru\Tutors;

class Tutor extends \Eloquent {
	protected $fillable = [ 'email','calendar_id','current_students',
        'past_students', 'freebusy','message_bag','photo','name',
        'notes','admin_notes','tutor_type','scheduledAppointments'];

    public function students()
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
