<?php namespace ScheduleGuru\GoogleConnect;

class GoogleClientCommand {

    public $client_id;

    public $client_secret;

    public $redirect_uri;

    public $client_scopes;

    public $accessType;

    function __construct($client_id, $client_secret, $redirect_uri, $client_scopes, $accessType = 'online' )
    {
        $this->$client_id = $client_id;
        $this->$client_secret = $client_secret ;
        $this->$redirect_uri = $redirect_uri;
        $this->$client_scopes = $client_scopes;
        $this->$accessType = $accessType;
    }
}