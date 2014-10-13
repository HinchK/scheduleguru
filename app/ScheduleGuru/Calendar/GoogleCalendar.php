<?php namespace ScheduleGuru\Calendar;

class GoogleCalendar extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['google-calendar-id','events'];



}