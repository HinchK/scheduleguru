<?php
return array(
    'index' => 'a/{provider}',
    'login' => 'a/login/{provider}',
    'loginredirect' => 'a/welcome',   // set this if you want a default redirect after login, else it will use back()
    'logout' => 'a/logout',
    'logoutredirect' => '/',
    'authfailed' => 'user/login',
    'endpoint' => '/', // set this if you want a default redirect after logout, else it will use back()
);
