@extends('site.layouts.gurubase')

{{-- Web site Title --}}
@section('title')
@parent
   |  {{{ String::title($student->name) }}}: convert-package
@stop

@section('content')
    <script type="text/css" src="{{ asset('devoops/plugins/fullcalendar/fullcalendar.css') }}"></script>

    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li>{{ link_to_route('student_management', 'Students') }}</li>
                <li><a href="#">Student Management</a></li>
            </ol>
            <div id="social" class="pull-right">
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <!--Start Dashboard 1-->
    <div id="dashboard-header" class="row">
        <div class="col-xs-12 col-sm-4 col-md-5">
            <h3>{{ $student->student_id }}</h3>
            <p>FullCal--CalendarID: {{ $student->calendarId }}</p>
        </div>
        <div class="clearfix visible-xs"></div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-table"></i>
                        <span>Tutoring Package for {{ $student->name }}</span>
                    </div>
                    <div class="box-icons">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="expand-link">
                            <i class="fa fa-expand"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                    <div class="no-move"></div>
                </div>
                <div class="box-content">

                    @if(!$scheduledSessions)
                        <h4>Uh oh, this student doesnt have any events!  Would you like to build a pacage</h4>
                        <p>TODO: KASEY-LINK TO PACKAGE BUILDER</p>
                        <a href="{{ $student->convertpkgURL()  }}"><p>convert to package</p></a>
                    @endif

                    <h4 class="page-header">found {{ count($scheduledSessions)  }} events for {{ $student->name }}</h4>

                    @if(count($scheduledSessions))

                        {{{ $sessionCount = 0 }}}
                        @foreach($scheduledSessions as $tpgsession)

                            {{{ $sessionCount++ }}}
                            {{ Form::open(['route' => 'convert_package_sessions', 'class' => 'form-horizontal']) }}
                                <div class="form-group has-success has-feedback">
                                    <label class="col-sm-1 control-label">Sess #{{ $sessionCount }}:</label>
                                    <label class="col-sm-1 control-label">When:</label>
                                    <div class="col-sm-3">
                                        {{ Form::text('session_day', Carbon::parse($tpgsession['start_time'])->toFormattedDateString(), ['class' => 'form-control', 'id' => 'input_date']) }}
                                        <span class="fa fa-calendar txt-danger form-control-feedback"></span>
                                    </div>
                                    <div class="col-sm-2">
                                        {{ Form::text('session_time', Carbon::parse($tpgsession['start_time'])->toTimeString(), ['class' => 'form-control', 'id' => 'input_time']) }}
                                        <span class="fa fa-clock-o txt-danger form-control-feedback"></span>
                                    </div>
                                    <div class="col-sm-2">
                                        {{ Form::text('session_time_end', Carbon::parse($tpgsession['end_time'])->toTimeString(), ['class' => 'form-control', 'id' => 'end_time']) }}
                                        <span class="fa fa-clock-o txt-danger form-control-feedback"></span>
                                    </div>
                                    <label class="col-sm-1 control-label">Location:</label>
                                    <div class="col-sm-2">
                                        {{ Form::text('location',  $tpgsession['location'], ['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group has-warning has-feedback">
                                    {{ Form::label('details_label', 'Details:', ['class' => 'col-md-1 control-label']) }}
                                    {{ Form::label('tutor_scrape', 'with', ['class' => 'col-md-1 control-label']) }}
                                    <div class="col-sm-2">
                                        {{ Form::text('tutor_unverified',  $tpgsession['tutor_unverified'], ['class' => 'form-control']) }}
                                    </div>
                                    {{ Form::label('test_label', 'tutoring', ['class' => 'col-md-1 control-label']) }}
                                    <div class="col-sm-2">
                                        {{ Form::text('session_type',  $tpgsession['session_type'], ['class' => 'form-control']) }}
                                    </div>
                                    {{ Form::label('type_label', 'for the', ['class' => 'col-md-1 control-label']) }}
                                    <div class="col-sm-2">
                                        {{ Form::text('test_type',  $tpgsession['test_type'], ['class' => 'form-control']) }}
                                    </div>
                                    {{ Form::hidden('start_time',  $tpgsession['start_time']) }}
                                    {{ Form::hidden('start_time',  $tpgsession['start_time']) }}
                                    {{ Form::hidden('gcal_status',  $tpgsession['gcal_status']) }}
                                    {{ Form::hidden('gcal_event_id', $tpgsession['gcal_event_id']) }}
                                    {{ Form::hidden('gcal_event_ical_id', $tpgsession['gcal_event_ical_id']) }}
                                    {{ Form::hidden('gcal_event_etag', $tpgsession['gcal_event_etag']) }}
                                    {{ Form::hidden('gcal_html_link', $tpgsession['gcal_html_link']) }}
                                    {{ Form::hidden('gcal_event_etag', $tpgsession['gcal_event_etag']) }}
                                    {{ Form::hidden('student_id', $tpgsession['student_id']) }}
                                </div>
                                {{--{{{ $tpgsession['summary_raw'] }}}--}}
                            {{ Form::close() }}

                        @endforeach

                    @endif

                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    {{--<script src="{{ asset('devoops/plugins/jquery/jquery.min.js') }}"></script>--}}
    {{--<script src="{{ asset('devoops/plugins/jquery-ui/jquery-ui.min.js') }}"></script>--}}
    <script type="text/javascript">
    // Run Select2 plugin on elements
    function DemoSelect2(){
        $('#s2_with_tag').select2({placeholder: "Select OS"});
        $('#s2_country').select2();
    }
    // Run timepicker
    function DemoTimePicker(){
        $('#input_time').timepicker({setDate: new Date()});
        $('#end_time').timepicker({setDate: new Date()});
    }
    $(document).ready(function() {
        // Create Wysiwig editor for textare
        TinyMCEStart('#wysiwig_simple', null);
        TinyMCEStart('#wysiwig_full', 'extreme');
        // Add slider for change test input length
        FormLayoutExampleInputLength($( ".slider-style" ));
        // Initialize datepicker
        $('#input_date').datepicker({setDate: new Date()});
        // Load Timepicker plugin
        LoadTimePickerScript(DemoTimePicker);
        // Add tooltip to form-controls
        $('.form-control').tooltip();
        LoadSelect2Script(DemoSelect2);
        // Load example of form validation
        LoadBootstrapValidatorScript(DemoFormValidator);
        // Add drag-n-drop feature to boxes
        WinMove();
    });
    </script>
@stop



