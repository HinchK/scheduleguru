@extends('site.layouts.default')

@section('styles')
@parent
<style>
.box {
    font-family: Arial, sans-serif;
    background-color: #F1F1F1;
    border: 0;
    width: 340px;
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
    margin: 0 auto 25px;
    text-align: center;
    padding: 10px 0;
}
.box img {
    padding: 10px 0;
}
.box a {
    color: #427fed;
    cursor: pointer;
    text-decoration: none;
}
.heading {
    text-align:center;
    padding:10px;
    font-family: 'Open Sans', arial;
    color: #555;
    font-size: 18px;
    font-weight: 400;
}
.circle-image {
    width: 100px;
    height: 100px;
    -webkit-border-radius: 50% ;
    border-radius: 50%;
}
.welcome {
    font-size: 16px;
    font-weight: bold;
    text-align: center;
    margin: 10px 0 0;
    min-height: 1em;
}
.oauthemail {
    font-size: 14px;
}
.logout {
    font-size: 13px;
    text-align: right;
    padding: 5px;
    margin: 20px 5px 0 5px;
    border-top: #CCCCCC 1px solid;
}
.logout a {
    color: #8E009C;
}
</style>
@stop
{{-- Content --}}
@section('content')
    <div class="page-header" xmlns="http://www.w3.org/1999/html">
       <h1 class="page-title">Superuser: Google Connect</h1>
    </div>
    <div class="box">
    <div class="heading">Authenticate with Google</div>
      <div>
        <!-- Show Login if the OAuth Request URL is set -->

          <img src="assets/img/user.png" width="100px" size="100px" /><br/>
          <a class='login' href="{{ URL::to($url) }}"><img class='login' src="assets/img/sign-in-with-google.png" width="250px" size="54px" /></a>
      </div>
    </div>

@stop