@extends('site.layouts.gurubase')

{{-- Web site Title --}}
@section('title')
@parent
   |  {{{ String::title($student->name) }}}: convert-package
@stop

@section('content')
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
                        {{-- */$sessionCount = 0;/* --}}
                            {{ Form::open(['route' => 'convert_package_sessions', 'class' => 'form-horizontal', 'id' => 'process_event']) }}
                            @foreach($scheduledSessions as $tpgsession)

                                {{-- */$sessionCount++;/* --}}
                                <legend>Event #{{ $sessionCount }}</legend>
                                <div class="form-group has-success has-feedback">
                                    <label class="col-sm-1 control-label">Scheduled:</label>
                                    <div class="col-sm-3">
                                        {{ Form::text('session_day', Carbon::parse($tpgsession['start_time'])->toDayDateTimeString(), ['class' => 'form-control', 'id' => 'datetime_example']) }}
                                        <span class="fa fa-calendar txt-danger form-control-feedback"></span>
                                    </div>
                                    <label class="col-sm-1 control-label">ending</label>
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
                                    {{--<div class="col-sm-2">--}}
                                        {{--{{ Form::checkbox('session_check', 'convert_event', true, ['class' => 'fa fa-square-o']) }} convert event--}}
                                    {{--</div>--}}
                                    <label class="col-sm-1 control-label">tutoring:</label>
                                    <div class="col-sm-2">
                                        <div class="toggle-switch toggle-switch-primary">
                                            <label>
                                                {{ Form::checkbox('session_check', 'convert_event', true) }}
                                                <div class="toggle-switch-inner"></div>
                                                <div class="toggle-switch-switch"><i class="fa fa-check"></i></div>
                                            </label>
                                        </div>

                                    </div>
                                    {{ Form::hidden('start_time',  $tpgsession['start_time']) }}
                                    {{ Form::hidden('start_time',  $tpgsession['start_time']) }}
                                    {{ Form::hidden('gcal_status',  $tpgsession['gcal_status']) }}
                                    {{ Form::hidden('gcal_event_id', $tpgsession['gcal_event_id']) }}
                                    {{ Form::hidden('gcal_event_ical_id', $tpgsession['gcal_event_ical_id']) }}
                                    {{ Form::hidden('gcal_event_etag', $tpgsession['gcal_event_etag']) }}
                                    {{ Form::hidden('gcal_html_link', $tpgsession['gcal_html_link']) }}
                                    {{ Form::hidden('student_id', $tpgsession['student_id']) }}
                                    {{--{{{ $tpgsession['summary_raw'] }}}--}}
                                </div>

                            @endforeach
                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2">
                                    {{ Form::button('Convert',['class' => 'btn btn-primary convert-btn', 'data-eventid' => $tpgsession['gcal_event_id']]) }}
                                </div>
                            </div>
                            {{ Form::close() }}

                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-search"></i>
                        <span>Contextual backgrounds</span>
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
                    <input
                    <p class="bg-primary">Simple info</p>
                    <p class="bg-success">Message success</p>
                    <p class="bg-info">Message info</p>
                    <p class="bg-warning">Message warning</p>
                    <p class="bg-danger">Message danger</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-8">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-search"></i>
                        <span>Validator forms</span>
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
                    <div class="form-group">
                        <h4 class="page-header">pre-submission check</h4>
                        <form class="form-horizontal" role="form" id="submit_all">
                            <div class="form-group">
                                <label class="col-sm-1 control-label" for="form-styles">JSON</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" rows="5" id="wysiwig_simple" name="event-collect"></textarea>
                                    <input type="hidden" id="event-collecter" name="event-collecter" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')

    <script type="text/javascript">
        $.fn.serializeObject = function () {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                    } else {
                        o[this.name] = this.value || '';
                    }
                });
            return o;
        };
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
            var formData = $('#process_event').serializeObject();
            var result = JSON.stringify(formData);
            $("textarea[name='event-collect']").val(result)
            $('#event-collecter').val(result);
            $('convert-btn').on('click', function(e){
                e.preventDefault();
                //var eventID = $(this).data('eventdid');
                var url = $('#process_event').attr('action');
                $.ajax({
                   url: url,
                   type: 'POST',
                   data: $('#submit_all').serialize(),
                   dataType: 'json',
                   success: function(){
                       alert("json ajax post ta-da");
                   }
                })
            });

            // Create Wysiwig editor for textare
            TinyMCEStart('#wysiwig_simple', null);
            TinyMCEStart('#wysiwig_full', 'extreme');
            // Add slider for change test input length
            FormLayoutExampleInputLength($( ".slider-style" ));
            // Initialize datepicker
            $('#input_date').datepicker({setDate: new Date()});
            // Load Timepicker plugin
            //LoadTimePickerScript(DemoTimePicker);
            LoadTimePickerScript(AllTimePickers);
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



