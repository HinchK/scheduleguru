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
            <link rel="stylesheet" type="text/css" href="/assets/js/plugins/jquery-notific8/jquery.notific8.min.css"/>
	</head>
    <body>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="/assets/js/plugins/jquery-notific8/jquery.notific8.min.js"></script>
        <script src="/assets/js/ui-notific8.js"></script>
        <div class="container-fluid">
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
        @include('notifications')
    {{--<script>--}}
        {{--@if ($message = Session::get('success') || $message = Session::get('flash_notification.message'))--}}
            {{--@if(is_array($message))--}}
                {{--@foreach ($message as $m)--}}
                    {{--$.notific8('{{ $m }}', {--}}
                        {{--heading: 'Welcome!',--}}
                        {{--theme: 'tangerine',--}}
                        {{--sticky: true,--}}
                        {{--zindex: '500',--}}
                        {{--life: '6000'--}}

{{--//                        verticalEdge: 'left',--}}
{{--//                        horizontalEdge: 'bottom'--}}
                    {{--});--}}

                    {{--$.notific8('zindex', 11500);--}}
                {{--@endforeach--}}
            {{--@else--}}
                {{--$.notific8('{{ $message }}', {--}}
                    {{--heading: 'Welcome!',--}}
                    {{--theme: 'tangerine',--}}
                    {{--sticky: true,--}}
                    {{--zindex: '10',--}}
                    {{--life: '6000'--}}
{{--//                    verticalEdge: 'left'--}}
{{--//                    horizontalEdge: 'bottom'--}}
                    {{--});--}}
                {{--$.notific8('zindex', 11500);--}}
            {{--@endif--}}
        {{--@endif--}}
    {{--</script>--}}
    {{--@yield('scripts')--}}
    </body>
</html>