<?php

use ScheduleGuru\Calendar\CalendarRepository;
use ScheduleGuru\Calendar\GoogleCalendar;
use ScheduleGuru\Student;
use ScheduleGuru\Students\StudentRepository;

class StudentsController extends \BaseController {

    protected $studentRepository;

    protected $student;

    function __construct(StudentRepository $studentRepository, Student $student)
    {
        parent::__construct();
        $this->studentRepository = $studentRepository;
        $this->student = $student;
    }

    public function studentPage($slug)
    {
        $student = $this->student->where('slug', '=', $slug)->first();
        if (is_null($student))
        {
            // If we ended up in here, it means that
            // a page or a blog post didn't exist.
            // So, this means that it is time for
            // 404 error page.
            return App::abort(404);
        }
        $events = CalendarRepository::fetchEvents($student->calendarId);
        \Debugbar::info($events);
        return View::make('site.dashboard.students.student', compact('student','events'));
    }

    public function manage()
    {
        $studentCals = GoogleCalendar::where('is_a', '=', 'Student')->get();
        $tutorCals = GoogleCalendar::where('is_a', '=', 'Tutor')->get();
        $students = Student::all();

        \Debugbar::info('Student cals Eloquent grab:');
        \Debugbar::info($studentCals);

        return View::make('site.dashboard.students.index', compact('studentCals', 'tutorCals', 'students'));
    }

}