<?php

use Laracasts\Commander\CommanderTrait;
use ScheduleGuru\Calendar\CalendarRepository;
use ScheduleGuru\Calendar\GoogleCalendar;
use ScheduleGuru\Calendar\PostPersonaBuilderCommand;

class GoogleCalendarsController extends \BaseController {
    use CommanderTrait;

    protected $calendarRepository;

    function __construct(CalendarRepository $calendarRepository)
    {
        $this->calendarRepository = $calendarRepository;
    }


    /**
	 * Display a listing of googlecalendars
	 *
	 * @return Response
	 */
	public function index()
	{
        $gCals = $this->calendarRepository->buildPrimaryCalendarList();
        $currentCals = GoogleCalendar::all();

        return View::make('site.dashboard.primary', compact('gCals','currentCals'));

        //$rawCalendars = $this->calendarRepository->buildPrimaryCalendarList();
        //return View::make('site.dashboard.primary')->with('calendars', $rawCalendars);

		//return View::make('googlecalendars.index', compact('googlecalendars'));
	}

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
	 * Store a newly created googlecalendar in storage.
	 *
	 * @return Response
	 */
    //TODO: EXPAND GOOGLE_CALENDARS DB TO INCLUDE EVERYTHING, BUILD ON BRAH!~
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

//        GoogleCalendar::create($data);

        return Redirect::refresh();
//		return Redirect::route('googlecalendars.index');
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
