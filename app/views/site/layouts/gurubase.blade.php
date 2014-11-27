<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Basic Page Needs
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

		<link href="{{ asset('devoops/plugins/bootstrap/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('devoops/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
		<link href="{{ asset('devoops/plugins/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
		<link href="{{ asset('devoops/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
		<link href="{{ asset('devoops/plugins/xcharts/xcharts.min.css') }}" rel="stylesheet">
		<link href="{{ asset('devoops/plugins/select2/select2.css') }}" rel="stylesheet">
		<link href="{{ asset('devoops/plugins/justified-gallery/justifiedGallery.css') }}" rel="stylesheet">
		<link href="{{ asset('devoops/css/style_v2.css') }}" rel="stylesheet">
		<link href="{{ asset('devoops/plugins/chartist/chartist.min.css') }} " rel="stylesheet">
		@yield('styles')
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
				<script src="http://getbootstrap.com/docs-assets/js/html5shiv.js"></script>
				<script src="http://getbootstrap.com/docs-assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
<body>
    <!--Start Header-->
    <div id="screensaver">
        <canvas id="canvas"></canvas>
        <i class="fa fa-lock" id="screen_unlock"></i>
    </div>
    @include('site.dashboard.partials.modal')

    @include('site.dashboard.partials.nav')
    <!--End Header-->
    <!--Start Container-->
    <div id="main" class="container-fluid">
        <div class="row">
            @include('site.dashboard.partials.sidebar')
            <!--Start Content-->
            <div id="content" class="col-xs-12 col-sm-10">
                @include('flash::message')
                <div id="about">
                    <div class="about-inner">
                        <h4 class="page-header">Open-source admin theme for you</h4>
                        <p>ScheduleGuru, by Kasey Hinchman</p>
                        <p>Made for my friends at <a href="http://testprepgurus.com" target="_blank">http://testprepgurus.com</a></p>
                        <p>Email - <a href="mailto:kasey.hinchman@gmail.com">kasey.hinchman@gmail.com</a></p>
                        <p>Problems? Issues? Ideas? Please feel free to contact me via email or on my two-way:</p>
                        <p>Cellie - 619_4l5_9322</p>
                    </div>
                </div>
                <div class="preloader">
                    <img src="{{ asset('devoops/img/devoops_getdata.gif') }}" class="devoops-getdata" alt="preloader"/>
                </div>
                @yield('content')

                <!--devoops ajax loader target-->
                {{--<div id="ajax-content"></div>--}}

            </div>
        </div>
    </div>
    <!--End Container-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="http://code.jquery.com/jquery.js"></script>-->
    <script src="{{ asset('devoops/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('devoops/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('devoops/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('devoops/plugins/justified-gallery/jquery.justifiedGallery.min.js') }}"></script>
    <script src="{{ asset('devoops/plugins/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('devoops/plugins/tinymce/jquery.tinymce.min.js') }}"></script>
    <!-- All functions for this theme + document.ready processing -->
    <script src="{{ asset('devoops/js/devoops.js') }}"></script>
    <script>
        $(document).ready(function () {
        	$('body').on('click', '.show-sidebar', function (e) {
        		e.preventDefault();
        		$('div#main').toggleClass('sidebar-show');
        		setTimeout(MessagesMenuWidth, 250);
        	});
        	var ajax_url = location.hash.replace(/^#/, '');
        	if (ajax_url.length < 1) {
        		ajax_url = 'ajax/dashboard.html';
        	}
        	LoadAjaxContent(ajax_url);
        	$('.main-menu').on('click', 'a', function (e) {
        		var parents = $(this).parents('li');
        		var li = $(this).closest('li.dropdown');
        		var another_items = $('.main-menu li').not(parents);
        		another_items.find('a').removeClass('active');
        		another_items.find('a').removeClass('active-parent');
        		if ($(this).hasClass('dropdown-toggle') || $(this).closest('li').find('ul').length == 0) {
        			$(this).addClass('active-parent');
        			var current = $(this).next();
        			if (current.is(':visible')) {
        				li.find("ul.dropdown-menu").slideUp('fast');
        				li.find("ul.dropdown-menu a").removeClass('active')
        			}
        			else {
        				another_items.find("ul.dropdown-menu").slideUp('fast');
        				current.slideDown('fast');
        			}
        		}
        		else {
        			if (li.find('a.dropdown-toggle').hasClass('active-parent')) {
        				var pre = $(this).closest('ul.dropdown-menu');
        				pre.find("li.dropdown").not($(this).closest('li')).find('ul.dropdown-menu').slideUp('fast');
        			}
        		}
        		if ($(this).hasClass('active') == false) {
        			$(this).parents("ul.dropdown-menu").find('a').removeClass('active');
        			$(this).addClass('active')
        		}
        		if ($(this).hasClass('ajax-link')) {
        			e.preventDefault();
        			if ($(this).hasClass('add-full')) {
        				$('#content').addClass('full-content');
        			}
        			else {
        				$('#content').removeClass('full-content');
        			}
        			var url = $(this).attr('href');
        			window.location.hash = url;
        			LoadAjaxContent(url);
        		}
        		if ($(this).attr('href') == '#') {
        			e.preventDefault();
        		}
        	});
        	var height = window.innerHeight - 49;
        	$('#main').css('min-height', height)
        		.on('click', '.expand-link', function (e) {
        			var body = $('body');
        			e.preventDefault();
        			var box = $(this).closest('div.box');
        			var button = $(this).find('i');
        			button.toggleClass('fa-expand').toggleClass('fa-compress');
        			box.toggleClass('expanded');
        			body.toggleClass('body-expanded');
        			var timeout = 0;
        			if (body.hasClass('body-expanded')) {
        				timeout = 100;
        			}
        			setTimeout(function () {
        				box.toggleClass('expanded-padding');
        			}, timeout);
        			setTimeout(function () {
        				box.resize();
        				box.find('[id^=map-]').resize();
        			}, timeout + 50);
        		})
        		.on('click', '.collapse-link', function (e) {
        			e.preventDefault();
        			var box = $(this).closest('div.box');
        			var button = $(this).find('i');
        			var content = box.find('div.box-content');
        			content.slideToggle('fast');
        			button.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        			setTimeout(function () {
        				box.resize();
        				box.find('[id^=map-]').resize();
        			}, 50);
        		})
        		.on('click', '.close-link', function (e) {
        			e.preventDefault();
        			var content = $(this).closest('div.box');
        			content.remove();
        		});
        	$('#locked-screen').on('click', function (e) {
        		e.preventDefault();
        		$('body').addClass('body-screensaver');
        		$('#screensaver').addClass("show");
        		ScreenSaver();
        	});
        	$('body').on('click', 'a.close-link', function(e){
        		e.preventDefault();
        		CloseModalBox();
        	});
        	$('#top-panel').on('click','a', function(e){
        		if ($(this).hasClass('ajax-link')) {
        			e.preventDefault();
        			if ($(this).hasClass('add-full')) {
        				$('#content').addClass('full-content');
        			}
        			else {
        				$('#content').removeClass('full-content');
        			}
        			var url = $(this).attr('href');
        			window.location.hash = url;
        			LoadAjaxContent(url);
        		}
        	});
        	$('#search').on('keydown', function(e){
        		if (e.keyCode == 13){
        			e.preventDefault();
        			$('#content').removeClass('full-content');
        			ajax_url = 'ajax/page_search.html';
        			window.location.hash = ajax_url;
        			LoadAjaxContent(ajax_url);
        		}
        	});
        	$('#screen_unlock').on('mouseover', function(){
        		var header = 'Enter current username and password';
        		var form = $('<div class="form-group"><label class="control-label">Username</label><input type="text" class="form-control" name="username" /></div>'+
        					'<div class="form-group"><label class="control-label">Password</label><input type="password" class="form-control" name="password" /></div>');
        		var button = $('<div class="text-center"><a href="index.html" class="btn btn-primary">Unlock</a></div>');
        		OpenModalBox(header, form, button);
        	});
        	$('.about').on('click', function(){
        		$('#about').toggleClass('about-h');
        	})
        	$('#about').on('mouseleave', function(){
        		$('#about').removeClass('about-h');
        	})
        });
    </script>
    @yield('scripts')
</body>
</html>
