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
        $calref = GoogleCalendar::post($command->cal_id, $command->is_a, $command->accessRole, $command->backgroundColor, $command->colorId, $command->deleted, $command->description, $command->etag, $command->foregroundColor, $command->hidden, $command->kind, $command->location, $command->primary, $command->selected, $command->summary, $command->summaryOverride, $command->timeZone);
        return $calref;
    }

}