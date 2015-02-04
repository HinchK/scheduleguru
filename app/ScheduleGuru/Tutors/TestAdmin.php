<?php namespace ScheduleGuru\Tutors;


class TestAdmin extends \Eloquent{

    protected $fillable = [];

    public function students()
    {
        return $this->belongsToMany('Student');
    }

    public function calendar()
    {
        return $this->hasOne('GoogleCalendar');
    }

}
