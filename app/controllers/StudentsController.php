<?php

use Laracasts\Flash\Flash;
use ScheduleGuru\Calendar\CalendarRepository;
use ScheduleGuru\Calendar\GoogleCalendar;
use ScheduleGuru\Events\TutorSessionEventRepository;
use ScheduleGuru\Students\Student;
use ScheduleGuru\Students\StudentRepository;

class StudentsController extends \BaseController {

    protected $studentRepository;

    protected $tutorSessionRepository;

    protected $student;

    /**
     * @param StudentRepository $studentRepository
     * @param Student $student
     * @param CalendarRepository $calendarRepository
     * @param TutorSessionEventRepository $tutorSessionRepository
     */
    function __construct(StudentRepository $studentRepository, Student $student, CalendarRepository $calendarRepository, TutorSessionEventRepository $tutorSessionRepository)
    {
        parent::__construct();
        $this->calendarRepository = $calendarRepository;
        $this->studentRepository = $studentRepository;
        $this->student = $student;
        $this->tutorSessionRepository = $tutorSessionRepository;
    }

//TODO convertEventsToPackage returns the old view....
    //
    /**
     * @param $studentslug
     * @return \Illuminate\View\View|void
     */
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

        return View::make('students.convertpkg', compact('scheduledSessions', 'student'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreatePackageSessions()
    {

        $tutoringEvents = Input::get('eventsJSON');
        $events = json_decode($tutoringEvents);
        //Todo: "message=Trying to get property of non-object"
        //...occuring on a healthy POST
        $studentID =  $events->pkgStudentId;
        $package =  $this->tutorSessionRepository->convertExistingEventsToPackage($events, $studentID);

        Debugbar::info("package->id value");
        Debugbar::info($package->id);

        $slug = $this->student->findOrFail($studentID)->slug;
        Session::put('package_id',$package->id);

        Debugbar::info("studentPage");

        return Redirect::action('StudentsController@studentPage', $slug)->with(['package_id' => $package->id]);
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

        //TODO: NEEDS TO CHECK IF STUDENT HAS PKG, NOT IF PKG
//        if($student->packageid){
        if(Session::has('package_id')){
            $convertedTPGevents = Session::get('package_id');
            \Debugbar::info('PACKAGE!!!!!!');
            \Debugbar::info($convertedTPGevents);
        }else{
            $convertedTPGevents = false;
            \Debugbar::info('NO PACKAGEID FOR STUDENT');
        }

        return View::make('students.student', compact('student','events','convertedTPGevents'));
//        return View::make('site.dashboard.students.student', compact('student','events','convertedTPGevents'));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function manage()
    {
        $studentCals = GoogleCalendar::where('is_a', '=', 'Student')->get();
        $tutorCals = GoogleCalendar::where('is_a', '=', 'Tutor')->get();
        $students = Student::all();

        \Debugbar::info('Student cals Eloquent grab:');
        \Debugbar::info($studentCals);

//OLD   return View::make('site.dashboard.students.index', compact('studentCals', 'tutorCals', 'students'));
        return View::make('students.index', compact('studentCals', 'tutorCals', 'students'));
    }

}
