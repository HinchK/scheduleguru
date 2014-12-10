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
                        <a href="{{ URL::to('guru/convert-events-for' , $student->slug)  }}"><p>convert to package</p></a>
                    @endif

                    <h3>found {{ count($scheduledSessions)  }} events</h3>

                    @if(count($scheduledSessions))
                        @foreach($scheduledSessions as $tpgsession)
                            <div class="row">
                                {{ $tpgsession['summary_raw'] }}
                                {{ Form::open(['route' => 'convert_package_sessions']) }}
                                    {{ Form::text('tutor_unverified',  $tpgsession['tutor_unverified']) }}
                                    {{ Form::text('location',  $tpgsession['location']) }}
                                    {{ Form::text('test_type',  $tpgsession['test_type']) }}
                                    {{ Form::text('session_type',  $tpgsession['session_type']) }}
                                    {{ Form::text('start_time',  $tpgsession['start_time']) }}
                                    {{ Form::hidden('gcal_event_id', $tpgsession['gcal_event_id']) }}
                                    {{ Form::hidden('gcal_event_ical_id', $tpgsession['gcal_event_ical_id']) }}
                                    {{ Form::hidden('gcal_event_etag', $tpgsession['gcal_event_etag']) }}
                                    {{ Form::hidden('gcal_html_link', $tpgsession['gcal_html_link']) }}
                                    {{ Form::hidden('gcal_event_etag', $tpgsession['gcal_event_etag']) }}
                                {{ Form::close() }}
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
@stop



