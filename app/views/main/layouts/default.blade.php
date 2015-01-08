<!DOCTYPE html>
<!--
 ScheduleGuru Dashboard Blade Template:  main.layouts.default

Metronic Version: 3.1.3
-->
<!--[if IE 8]><html lang="en" class="ie8 no-js"><![endif]-->
<!--[if IE 9]><html lang="en" class="ie9 no-js"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>
        @section('title')
            Test Prep Gurus: Portal
        @show
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @section('meta_keywords')
        <meta name="keywords" content="TestPrepGurus, SAT, ACT, Tutoring" />
    @show
    @section('meta_author')
        <meta name="author" content="Kasey Hinchman" />
    @show
    @section('meta_description')
        <meta name="description" content="TestPrepGurus Student Scheduling System Vertical Dashboard" />
    @show
                <!-- Mobile Specific Meta
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    {{ HTML::style('metro/plugins/font-awesome/css/font-awesome.min.css')  }}
    {{ HTML::style('metro/plugins/simple-line-icons/simple-line-icons.min.css') }}
    {{ HTML::style('metro/plugins/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('metro/plugins/uniform/css/uniform.default.css') }}
    {{ HTML::style('metro/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    {{ HTML::style('metro/plugins/gritter/css/jquery.gritter.css') }}
    {{ HTML::style('metro/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}
    {{ HTML::style('metro/plugins/fullcalendar/fullcalendar/fullcalendar.css') }}
    {{ HTML::style('metro/plugins/jqvmap/jqvmap/jqvmap.css') }}
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN PAGE STYLES -->
    {{ HTML::style('metro/pages/css/tasks.css') }}
    <!-- END PAGE STYLES -->
    <!-- BEGIN THEME STYLES -->
    {{ HTML::style('metro/css/components.css') }}
    {{ HTML::style('metro/css/plugins.css') }}
    {{ HTML::style('metro/layout/css/layout.css') }}
    {{ HTML::style('metro/layout/css/themes/default.css', ['id' => 'style-color']) }}
    {{ HTML::style('metro/layout/css/custom.css') }}
    <!-- END THEME STYLES -->
    @yield('styles')
    {{--<link rel="shortcut icon" href="favicon.ico"/>--}}
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content">
<!-- HEADER -->
@include('main.partials.header')

<div class="clearfix">
</div>
<!-- CONTAINER -->
<div class="page-container">

    @include('main.slice.sidebar')


    <div class="page-content-wrapper">
        <div class="page-content">

            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM -->
            @include('main.partials.dashconfig')

             <!-- BEGIN STYLE CUSTOMIZER -->
            @include('main.partials.stylecustomizer')
            <!-- PAGE HEADER -->
            <h3 class="page-title">
                TestPrepGurus <small>schedule management portal</small>
            </h3>
            {{-- BREADCRUMB ROUTES --}}
            <div class="page-bar">

            @yield('breadcrumbs')

            </div>

            @yield('content')

        </div>
    </div>
    <!-- END CONTENT -->
    <!-- QUICK SIDEBAR -->
    <a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>

    @include('main.slice.quickside')

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
@include('main.slice.footer')
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
{{ HTML::script('metro/plugins/respond.min.js') }}
{{ HTML::script('metro/plugins/excanvas.min.js') }}
<![endif]-->
{{ HTML::script('metro/plugins/jquery-1.11.0.min.js') }}
{{ HTML::script('metro/plugins/jquery-migrate-1.2.1.min.js') }}
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
{{ HTML::script('metro/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') }}
{{ HTML::script('metro/plugins/bootstrap/js/bootstrap.min.js') }}
{{ HTML::script('metro/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}
{{ HTML::script('metro/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}
{{ HTML::script('metro/plugins/jquery.blockui.min.js') }}
{{ HTML::script('metro/plugins/jquery.cokie.min.js') }}
{{ HTML::script('metro/plugins/uniform/jquery.uniform.min.js') }}
{{ HTML::script('metro/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->

{{ HTML::script('metro/plugins/flot/jquery.flot.min.js') }}
{{ HTML::script('metro/plugins/flot/jquery.flot.resize.min.js') }}
{{ HTML::script('metro/plugins/flot/jquery.flot.categories.min.js') }}
{{ HTML::script('metro/plugins/jquery.pulsate.min.js') }}
{{ HTML::script('metro/plugins/bootstrap-daterangepicker/moment.min.js') }}
{{ HTML::script('metro/plugins/bootstrap-daterangepicker/daterangepicker.js') }}
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
{{ HTML::script('metro/plugins/fullcalendar/fullcalendar/fullcalendar.min.js') }}
{{ HTML::script('metro/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}
{{ HTML::script('metro/plugins/jquery.sparkline.min.js') }}
{{ HTML::script('metro/plugins/gritter/js/jquery.gritter.js') }}
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
{{ HTML::script('metro/scripts/metronic.js') }}
{{ HTML::script('metro/layout/scripts/layout.js') }}
{{ HTML::script('metro/layout/scripts/quick-sidebar.js') }}
{{ HTML::script('metro/layout/scripts/demo.js') }}
{{ HTML::script('metro/pages/scripts/index.js') }}
{{ HTML::script('metro/pages/scripts/tasks.js') }}
<!-- END PAGE LEVEL SCRIPTS -->
{{-- TODO: Consistant propagation of $(doc).ready... --}}
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
        Index.init();
        Index.initDashboardDaterange();

        Index.initCalendar(); // init index page's custom scripts

    });
</script>
@yield('scripts')
<!-- END JAVASCRIPTS -->
<!-- NOPE
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37564768-1', 'keenthemes.comp');
  ga('send', 'pageview');
</script> -->
</body>

<!-- END BODY -->
</html>
