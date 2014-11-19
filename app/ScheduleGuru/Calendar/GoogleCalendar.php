<?php namespace ScheduleGuru\Calendar;

use ScheduleGuru\Tutor;
use ScheduleGuru\Student;

class GoogleCalendar extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'cal_id' => 'required',
        'is_a'  => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['cal_id','is_a'];

    /**
     * @param $cal_id
     * @param $is_a
     * @param $cal_summary
     * @param $cal_bg_color
     * @return static
     */
    public static function post( $cal_id, $is_a, $cal_summary, $cal_bg_color)
    {

        $calendarReference = GoogleCalendar::create(['cal_id' => $cal_id, 'is_a' => $is_a, 'cal_summary' => $cal_summary, 'cal_bg_color' => $cal_bg_color]);


        if($is_a === 'TU'){
            Tutor::buildTutorProfile($cal_id, $cal_summary);
        }
        if($is_a === 'ST'){
            Student::buildStudentProfile($cal_id,  $cal_summary);
        }
        \Debugbar::info('calendarReference value: ');
        \Debugbar::info($calendarReference);
        return $calendarReference;

    }

}