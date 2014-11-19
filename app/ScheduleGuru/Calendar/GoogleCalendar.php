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
     * @param $accessRole
     * @param $backgroundColor
     * @param $colorId
     * @param $deleted
     * @param $description
     * @param $etag
     * @param $foregroundColor
     * @param $hidden
     * @param $kind
     * @param $location
     * @param $primary
     * @param $selected
     * @param $summary
     * @param $summaryOverride
     * @param $timeZone
     * @internal param $cal_summary
     * @internal param $cal_bg_color
     * @return static
     */
    public static function post( $cal_id, $is_a, $accessRole, $backgroundColor, $colorId, $deleted, $description, $etag, $foregroundColor, $hidden, $kind, $location, $primary, $selected, $summary, $summaryOverride, $timeZone)
    {

        $calendarReference = GoogleCalendar::create(['cal_id' => $cal_id, 'is_a' => $is_a, 'accessRole' => $accessRole, 'backgroundColor' => $backgroundColor, 'colorId' => $colorId, 'deleted' => $deleted, 'description' => $description, 'etag' => $etag, 'foregroundColor' => $foregroundColor, 'hidden' => $hidden, 'kind' => $kind, 'location' => $location, 'primary' => $primary, 'selected' => $selected, 'summary' => $summary, 'summaryOverride' => $summaryOverride, 'timeZone' => $timeZone]);


        if($is_a === 'TU'){
            Tutor::buildTutorProfile($cal_id, $summary);
        }
        if($is_a === 'ST'){
            Student::buildStudentProfile($cal_id,  $summary);
        }
        \Debugbar::info('calendarReference value: ');
        \Debugbar::info($calendarReference);
        return $calendarReference;

    }

}