<?php namespace ScheduleGuru\Calendar;

use Laracasts\Commander\CommandHandler;

class PostPersonaBuilderCommandHandler implements CommandHandler {

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
        $calref = GoogleCalendar::post($command->cal_id, $command->is_a, $command->cal_summary, $command->cal_bg_color);
        return $calref;
    }

}