@extends('site.layouts.kickoff')

@section('content')
    @if( !$currentUser )
        <h4>Authenticate via Google</h4>
        <img src="assets/img/user.png" width="100px" size="100px" /><br/>
        <a class='login' href="{{ URL::to($url) }}"><img class='login' src="assets/img/sign-in-with-google.png" width="250px" size="54px" /></a>
    @else
        <h4>Seems like you're already logged in partner!</h4>
        <b>{{ link_to_route('dashboard_primary', 'TO THE DASHBOARD !') }}</b></a>
        <div class='logout'>{{ link_to_route('google_logout', 'Logout') }}</div>
    @endif
@stop