<?php

use Illuminate\Support\Facades\Redirect;
use Laracasts\Commander\CommanderTrait;
use Laracasts\Flash\Flash;
use ScheduleGuru\Calendar\CalendarRepository;
use ScheduleGuru\Calendar\GoogleCalendar;
use ScheduleGuru\Calendar\PostPersonaBuilderCommand;
use ScheduleGuru\Students\Student;
use ScheduleGuru\Students\StudentRepository;
use ScheduleGuru\Tutor;

class GoogleCalendarsController extends \BaseController {
    use CommanderTrait;

    protected $calendarRepository;

    protected $studentRepostiory;

    function __construct(CalendarRepository $calendarRepository, StudentRepository $studentRepository)
    {
        $this->calendarRepository = $calendarRepository;
        $this->studentRepository = $studentRepository;
    }


    /**
	 * Display a listing of googlecalendars
	 *
	 * @return Response
	 */
	public function index()
	{

        $gCals = $this->calendarRepository->buildPrimaryCalendarList();
        //will return false if google auth disconnect
        if( ! $gCals){
            Confide::logout();
            Flash::error('Inactivity timeout, please login again (google_auth_exception)');
            return Googlavel::logout('/');
        }
        //$hintStudents returns 3 arrays in 1 [students, tutors, TAs];
        $hintMultiArray = $this->calendarRepository->summaryHintAnalysis($gCals);
        $possStudents = $hintMultiArray[0];
        $possTutors = $hintMultiArray[1];
        $possTAs = $hintMultiArray[2];

        $studentCals = GoogleCalendar::where('is_a', '=', 'Student')->get();
        $tutorCals = GoogleCalendar::where('is_a', '=', 'Tutor')->get();

        $addedStus = null;

        if(Session::has('newStudents')){
            $addedStus = Session::pull('newStudents');
            \Debugbar::info('new students added');
            \Debugbar::info($addedStus);

            \Flash::message(implode(',\n', $addedStus));
        }

        return View::make('home', compact('gCals','possStudents','possTutors','possTAs','studentCals','tutorCals'));
	}

    /**
     * Batch import students
     *
     */
    public function studentImporter()
    {
        $incomingCalIDs = Input::all();

        $calDataArray = [];
        $key = 0;

        //TODO: [20120222] Brooklyn Boukather-problem [no description, no student?]
        foreach($incomingCalIDs as $ids){
            foreach($ids as $id) {

                $tpgGoogleWorkingCalendar = $this->calendarRepository->fetchCalObjectAttributesAndStore($id, 'Student');

                $newStudent = Student::whereCalendarId($id)->first();  //put in studentRepo

                $calDataArray[$key] = $newStudent->student_id;
                $key++;
            }
        }
        Session::put('newStudents', $calDataArray);

        //TODO: ALSO NEED TO CLEAN THE POSSIBLE STUDENT LIST PRE-REFRESH

        return "Student import complete...";

        //return Redirect::route('dashboard_primary')->with('message', 'Students imported sucessfully!');;


    }
	/**
	 * Store a newly created googlecalendar in storage.
	 *
	 * @return Response
	 */

	public function store()
	{
		$validator = Validator::make($data = Input::all(), GoogleCalendar::$rules);
        Debugbar::info("sending to bus");
        Debugbar::info($data);

        $this->execute(PostPersonaBuilderCommand::class);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        return Redirect::refresh();
	}

// TODO: Below this point is #>php artisan generate::scaffold stuff
// kept in as a reminder of how hard i zig when like, the man wants me to zag
// and also for reference/stubs/groudnwork towards TODO: build core new student func

    /**
     * Show the form for creating a new googlecalendar
     *
     * @return Response
     */
    public function create()
    {
        return View::make('googlecalendars.create');
    }

	/**
	 * Display the specified googlecalendar.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$googlecalendar = GoogleCalendar::findOrFail($id);

		return View::make('googlecalendars.show', compact('googlecalendar'));
	}

	/**
	 * Show the form for editing the specified googlecalendar.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$googlecalendar = GoogleCalendar::find($id);

		return View::make('googlecalendars.edit', compact('googlecalendar'));
	}

	/**
	 * Update the specified googlecalendar in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$googlecalendar = GoogleCalendar::findOrFail($id);

		$validator = Validator::make($data = Input::all(), GoogleCalendar::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$googlecalendar->update($data);

		return Redirect::route('googlecalendars.index');
	}

	/**
	 * Remove the specified googlecalendar from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Googlecalendar::destroy($id);

		return Redirect::route('googlecalendars.index');
	}

    public function getData()
    {
        $calendars = $this->calendarRepository->buildPrimaryCalendarList();

        foreach ($calendars as $cal) {
            $cal[] = select(array($cal->summary, $cal->id, $cal->colorId, $cal->description));
        }
        return Datatables::of($cal);

    }

    /**
     * Marked for deletion
     * kept in as fancy datatable reference
     *
     * @return mixed
     */
    public function oldgetdata(){

        $users = User::leftjoin('assigned_roles', 'assigned_roles.user_id', '=', 'users.id')
            ->leftjoin('roles', 'roles.id', '=', 'assigned_roles.role_id')
            ->select(array('users.id', 'users.username','users.email', 'roles.name as rolename', 'users.confirmed', 'users.created_at'));

        return Datatables::of($users)
            // ->edit_column('created_at','{{{ Carbon::now()->diffForHumans(Carbon::createFromFormat(\'Y-m-d H\', $test)) }}}')

            ->edit_column('confirmed','@if($confirmed)
                            Yes
                        @else
                            No
                        @endif')

            ->add_column('actions', '<a href="{{{ URL::to(\'admin/users/\' . $id . \'/edit\' ) }}}" class="iframe btn btn-xs btn-default">{{{ Lang::get(\'button.edit\') }}}</a>
                                @if($username == \'admin\')
                                @else
                                    <a href="{{{ URL::to(\'admin/users/\' . $id . \'/delete\' ) }}}" class="iframe btn btn-xs btn-danger">{{{ Lang::get(\'button.delete\') }}}</a>
                                @endif
            ')

            ->remove_column('id')

            ->make();
    }
}
