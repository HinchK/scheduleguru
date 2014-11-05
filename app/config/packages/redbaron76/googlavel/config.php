<?php

return [

    // OAuth2 Setting, you can get these keys in Google Developers Console
    'oauth2_client_id'      => getenv( 'GOOG_CLIENT_ID'),
    'oauth2_client_secret'  => getenv( 'GOOG_CLIENT_SECRET' ),
    'oauth2_redirect_uri'   => 'http://localhost:8000/google',   // Change it according to your needs

    // Definition of service specific values like scopes, OAuth token URLs, etc
    //
//    https://www.googleapis.com/auth/userinfo.email
//    https://www.googleapis.com/auth/userinfo.profile
//    https://www.googleapis.com/auth/plus.me
//    https://www.googleapis.com/auth/calendar
//-dont need this:  https://www.googleapis.com/auth/calendar.readonly
//    https://mail.google.com/
//-dont need these
//    https://www.googleapis.com/auth/gmail.readonly
//    https://www.googleapis.com/auth/gmail.modify
//    https://www.googleapis.com/auth/gmail.compose
    'services' => array(

        'calendar' => array(
            'scope' => 'https://www.googleapis.com/auth/calendar'
        ),
        'gmail' => array(
            'scope' => 'https://mail.google.com'
        ),
        'gmail.readonly' => array(
            'scope' => 'https://www.googleapis.com/auth/gmail.readonly'
        ),
        'gmail.compose' => array(
            'scope' => 'https://www.googleapis.com/auth/gmail.compose'
        ),
        'gmail.modify' => array(
            'scope' => 'https://www.googleapis.com/auth/gmail.modify'
        ),
        'Oauth' => array(
            'scope' => 'https://www.googleapis.com/auth/userinfo.email'
        ),
        /*'books' => [
            'scope' => 'https://www.googleapis.com/auth/books'
        ]*/

    ),
    // Service file name prefix
    'service_class_prefix' => 'Google_Service_',

    // Custom settings
    'access_type' => 'offline',
    'approval_prompt' => 'auto',

];