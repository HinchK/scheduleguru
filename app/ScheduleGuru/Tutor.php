<?php namespace ScheduleGuru;

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
        return $newTutor;
    }
}