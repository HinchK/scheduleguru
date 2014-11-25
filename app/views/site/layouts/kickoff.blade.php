<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- devoop-inspired login lander - google kickoff
		================================================== -->
		<meta charset="utf-8" />
		<title>
			@section('title')
			Test Prep Gurus: Portal
			@show
		</title>
		@section('meta_keywords')
		<meta name="keywords" content="TestPrepGurus, SAT, ACT, Tutoring" />
		@show
		@section('meta_author')
		<meta name="author" content="Kasey Hinchman" />
		@show
		@section('meta_description')
		<meta name="description" content="TestPrepGurus Student Scheduling System Vertical Dashboard" />
        @show
		<!-- Mobile Specific Metas
		================================================== -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="{{{ asset('devoops/plugins/bootstrap/bootstrap.css') }}}" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="{{{ asset('devoops/css/style_v2.css') }}}" rel="stylesheet">
        @section('styles')
        @show
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
        <!-- Favicons
        ================================================== -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" href="{{{ asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">
        <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}">
	</head>
    <body>
        <div class="container-fluid">
            <!-- Notifications -->
                @include('notifications')
                    @if (Session::has('flash_notification.message'))
                        <div class="alert alert-{{ Session::get('flash_notification.level') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                            {{ Session::get('flash_notification.message') }}
                        </div>
                    @endif
			<!-- ./ notifications -->
            <div id="page-login" class="row">
                <div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="text-right">
                        {{--<a href="thislinkisimaginary.html" class="txt-default">Placeholder for a link to registration or something</a>--}}
                    </div>
                    <div class="box">
                        <div class="box-content">
                            <div class="text-center">
                                <h3 class="page-header">TestPrepGuru: Account Login </h3>
                            </div>
                            <div class="text-center">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>