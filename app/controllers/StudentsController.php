<?php

use ScheduleGuru\Calendar\GoogleCalendar;
use ScheduleGuru\Students\StudentRepository;

class StudentsController extends \BaseController {

    protected $studentRepository;

    function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function manage()
    {
        $studentCals = GoogleCalendar::where('is_a', '=', 'Student')->get();
        $tutorCals = GoogleCalendar::where('is_a', '=', 'Tutor')->get();

        \Debugbar::info('Student cals Eloquent grab:');
        \Debugbar::info($studentCals);

        return View::make('site.dashboard.students.index', compact('studentCals', 'tutorCals'));
    }

}