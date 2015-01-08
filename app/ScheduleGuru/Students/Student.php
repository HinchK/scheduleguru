<?php namespace ScheduleGuru\Students;

use Illuminate\Support\Facades\URL;

class Student extends \Eloquent {
	protected $fillable = ['student_id', 'calendarId', 'name', 'slug'];

    public function tutors()
    {
        return $this->hasMany('Tutor');
    }

    public function tutoringSessions()
    {
        return $this->hasMany('ScheduledTutorSession');
    }

    /**
     * @return mixed
     */
    public function url()
    {
//        return URL::to('guru/' . $this->slug);
        return URL::to('student/' . $this->slug);
    }

    public function convertpkgURL()
    {
        return URL::to('guru/' . $this->slug . '/convert-events');
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
