<?php namespace ScheduleGuru;


class ScheduledSession extends \Eloquent{

    public function student()
    {
        return $this->hasOne('Student');
    }

    public function tutor()
    {
        return $this->hasOne('Tutor');
    }

    public function createdDate($date=null)
    {
        if(is_null($date)) {
            $date = $this->created_at;
        }
        return String::date($date);
    }

} 