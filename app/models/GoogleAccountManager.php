<?php

use Laracasts\Commander\Events\EventGenerator;

class GoogleAccountManager extends Eloquent
{
    use EventGenerator;

    public static function setup($client)
    {
        $calservice = new Google_Service_Calendar($client);
        $calendarList = $calservice->calendarList->listCalendarList();
        dd($calendarList);
    }



} 