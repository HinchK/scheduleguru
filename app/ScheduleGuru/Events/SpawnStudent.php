<?php namespace ScheduleGuru\Events;


use ScheduleGuru\Calendar\GoogleCalendar;

class SpawnStudent {

    public $student;

    public $calref;

    public function __construct(GoogleCalendar $calref)
    {
        $this->calref = $calref;
    }
} 