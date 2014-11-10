<?php namespace ScheduleGuru\Calendar;

class PostPersonaBuilderCommand {

    /**
     * @var
     * googleListCalendar->id
     */
    public $cal_id;

    /**
     * @var
     * types(   'TU' => 'Tutor',
     *          'ST' => 'Student',
     *          'EV' => 'Special Event',
     *          'NA' => 'No association'    )
     */
    public $is_a;

    public $cal_summary;

    public $cal_bg_color;

    /**
     * @param $cal_id
     * @param $is_a
     * @param $cal_summary
     * @param $cal_bg_color
     */
    public function __construct($cal_id, $is_a, $cal_summary, $cal_bg_color)
    {
        $this->cal_id = $cal_id;
        $this->is_a = $is_a;
        $this->cal_summary = $cal_summary;
        $this->cal_bg_color = $cal_bg_color;
    }

}