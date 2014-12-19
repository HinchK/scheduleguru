<?php

use Laracasts\Flash\Flash;
use ScheduleGuru\Calendar\CalendarRepository;
use ScheduleGuru\Calendar\GoogleCalendar;
use ScheduleGuru\Students\Student;
use ScheduleGuru\Students\StudentRepository;

class StudentsController extends \BaseController {

    protected $studentRepository;

    protected $student;

    function __construct(StudentRepository $studentRepository, Student $student, CalendarRepository $calendarRepository)
    {
        parent::__construct();
        $this->calendarRepository = $calendarRepository;
        $this->studentRepository = $studentRepository;
        $this->student = $student;
    }

    public function convertEventsToPackage($studentslug)
    {
        $student = $this->student->where('slug', '=', $studentslug)->first();
        if (is_null($student))
        {
            // If we ended up in here, it means that
            // a page or a blog post didn't exist.
            // So, this means that it is time for
            // 404 error page.
            return App::abort(404);
        }
        $events = $this->calendarRepository->fetchEvents($student->calendarId);
        $scheduledSessions = $this->studentRepository->buildEventSessionConversionArray($events, $student);

        return View::make('site.dashboard.students.convertpkg', compact('scheduledSessions', 'student'));
    }

    public function postCreatePackageSessions()
    {
        $tutoringEvents = Input::all();

        \Debugbar::info('StudentController.postCreatePackageSessions:');
        \Debugbar::info($tutoringEvents);

        return Redirect::back();
        return var_dump($tutoringEvents);
    }

    /**
     * @param $slug
     * @return \Illuminate\View\View|void
     */
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
        $events = $this->calendarRepository->fetchEvents($student->calendarId);

        if( ! $events){
            Confide::logout();
            Flash::error('Inactivity timeout, please login again (google_auth_exception)');
            return Googlavel::logout('/');
        }

        if($student->packageid){
            \Debugbar::info($student->packageid);
        }else{
            $convertedTPGevents = false;
            \Debugbar::info('NO PACKAGEID FOR STUDENT');
        }


        return View::make('site.dashboard.students.student', compact('student','events','convertedTPGevents'));
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