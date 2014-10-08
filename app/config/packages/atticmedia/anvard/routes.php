<?php
return array(
    'index' => 'anvard',
    'login' => 'a/login/{provider}',
    'loginredirect' => '/',   // set this if you want a default redirect after login, else it will use back()
    'logout' => 'anvard/logout',
    'logoutredirect' => '/',
    'authfailed' => 'user/login',
    'endpoint' => 'anvard/endpoint', // set this if you want a default redirect after logout, else it will use back()
);
