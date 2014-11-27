<?php namespace ScheduleGuru;

use Illuminate\Support\Facades\URL;
use Str;

class Student extends \Eloquent {
	protected $fillable = ['student_id', 'calendarId', 'name', 'slug'];

    public function tutors()
    {
        return $this->hasMany('Tutor');
    }

    public function tutoringSessions()
    {
        return $this->hasMany('ScheduledSession');
    }

    /**
     * @return mixed
     */
    public function url()
    {
        return URL::to('guru/' . $this->slug);
    }

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
        \Debugbar::info('student id/slug stuff');
        \Debugbar::info($studentIdmaker);
        if(is_array($studentIdmaker)){
            $studentId = $studentIdmaker[0];
        }else{
            $studentId = $studentIdmaker;
        }
        $slug = Str::slug($studentId);
        \Debugbar::info('Slug: '.$slug);
        $newStudent = Student::create(['student_id' => $studentId, 'calendarId' => $cal_id,'name' => $cal_summary, 'slug' => $slug]);
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