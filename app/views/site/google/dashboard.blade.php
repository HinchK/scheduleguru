@extends('site.layouts.default')

{{-- Content --}}
@section('content')
<div class="heading">Google Account Login</div>
<div class="box">
  <div>
	<!-- Show User Profile otherwise-->
	  <img class="circle-image" src="<?php echo $userData["picture"]; ?>" width="100px" size="100px" /><br/>
	  <p class="welcome">Welcome <a href="<?php echo $userData["link"]; ?>" /><?php echo $userData["name"]; ?></a>.</p>
	  <p class="oauthemail"><?php echo $userData["email"]; ?></p>
	  <div class='logout'><a href='?logout'>Logout</a></div>
  </div>
</div>