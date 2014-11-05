<?php namespace ScheduleGuru\GoogleConnect;

use User;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class GoogleClientCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    protected $repository;

    function __construct(GoogleClientRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the command
     *
     * @param $command
     * @return mixed
     */
    public function handle($command)
    {
            $authenticatedClient = $this->repository->authenticate($command->googleClient);

            if(!$authenticatedClient){
                return false;
            }

            $gAcctMgr = \GoogleAccountManager:: setup($authenticatedClient);

    }


} 