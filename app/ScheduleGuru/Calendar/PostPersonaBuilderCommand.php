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

    public $accessRole;
    public $backgroundColor;
    public $colorId;
    public $deleted;
    public $description;
    public $etag;
    public $foregroundColor;
    public $hidden;
    public $kind;
    public $location;
    public $primary;
    public $selected;
    public $summary;
    public $summaryOverride;
    public $timeZone;

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
     */
    public function __construct($cal_id, $is_a, $accessRole, $backgroundColor, $colorId, $deleted, $description, $etag, $foregroundColor, $hidden, $kind, $location, $primary, $selected, $summary, $summaryOverride, $timeZone)
    {
        $this->cal_id = $cal_id;
        $this->is_a = $is_a;
        $this->accessRole = $accessRole;
        $this->backgroundColor = $backgroundColor;
        $this->colorId = $colorId;
        $this->deleted = $deleted;
        $this->description = $description;
        $this->etag = $etag;
        $this->foregroundColor = $foregroundColor;
        $this->hidden = $hidden;
        $this->kind = $kind;
        $this->location = $location;
        $this->primary = $primary;
        $this->selected = $selected;
        $this->summary = $summary;
        $this->summaryOverride = $summaryOverride;
        $this->timeZone = $timeZone;
    }

}