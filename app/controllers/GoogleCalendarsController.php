<?php

use ScheduleGuru\Calendar\GoogleCalendar;

class GoogleCalendarsController extends \BaseController {

	/**
	 * Display a listing of googlecalendars
	 *
	 * @return Response
	 */
	public function index()
	{
		$googlecalendars = GoogleCalendar::all();

		return View::make('googlecalendars.index', compact('googlecalendars'));
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
	public function store()
	{
		$validator = Validator::make($data = Input::all(), GoogleCalendar::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        GoogleCalendar::create($data);

		return Redirect::route('googlecalendars.index');
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

}
