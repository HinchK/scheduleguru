<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 10/15/2014
 * Time: 6:41 PM
 */

namespace ScheduleGuru\GoogleConnect;

use User;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class GoogleClientCmdHandler implements CommandHandler
{
    use DispatchableTrait;

    function __construct()
    {
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
        // TODO: Implement handle() method.
    }


} 