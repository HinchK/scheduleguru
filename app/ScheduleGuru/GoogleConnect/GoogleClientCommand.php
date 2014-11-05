<?php namespace ScheduleGuru\GoogleConnect;

class GoogleClientCommand {

    public $googleClient;

    function _construct($googleClient)
    {
        $this->googleClient = $googleClient;
    }
}