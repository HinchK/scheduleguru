@extends('site.layouts.gurubase')

{{-- Web site Title --}}
@section('title')
@parent
   |  {{{ String::title($student->name) }}}: convert-package
@stop

@section('styles')
    <link rel="stylesheet" href="/bs_dtp/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
@stop

@section('content')
    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li>{{ link_to_route('student_management', 'Students') }}</li>
                <li><a href="{{ URL::to('/guru/'. $student->slug) }}">{{ $student->name }}</a></li>
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
        <div class="col-xs-12 col-sm-5">
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

                    @foreach($scheduledSessions as $tutoringevent)

                        @if($tutoringevent['session_type'] == 'Math')
                            <p class="bg-danger">
                                {{ $tutoringevent['test_type'] }}|MATH with {{ $tutoringevent['tutor_unverified']  }}: {{ Carbon::parse($tutoringevent['start_time'])->toDayDateTimeString() }}-{{ Carbon::parse($tutoringevent['end_time'])->format('h:i a') }} @ at {{ $tutoringevent['location'] }}
                            </p>
                        @elseif($tutoringevent['session_type'] == 'Verbal')
                            <p class="bg-primary">
                                {{ $tutoringevent['test_type'] }}|VERBAL with {{ $tutoringevent['tutor_unverified']  }}: {{ Carbon::parse($tutoringevent['start_time'])->toDayDateTimeString() }}-{{ Carbon::parse($tutoringevent['end_time'])->format('h:i a') }} @ at {{ $tutoringevent['location'] }}
                            </p>
                        @elseif($tutoringevent['session_type'] == 'EXAM')
                            <p class="bg-warning">
                                {{ $tutoringevent['tutor_unverified']  }}: {{ Carbon::parse($tutoringevent['start_time'])->toDayDateTimeString() }}-{{ Carbon::parse($tutoringevent['end_time'])->format('h:i a') }} @ at {{ $tutoringevent['location'] }}
                            </p>
                        @else
                            <p class="bg-info">!!This event has issues; here's the raw data: {{ $tutoringevent['summary'] }}</p>
                        @endif

                    @endforeach

                    <p class="bg-primary">Simple info</p>
                    <p class="bg-success">Message success</p>
                    <p class="bg-info">Message info</p>
                    <p class="bg-warning">Message warning</p>
                    <p class="bg-danger">Message danger</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-7">
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
                            <input type="submit" />
                            <h2>mode: combine</h2>
                            <pre><code id="testAreaCombine">
                                </code></pre>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

                                <legend>Event #{{ $sessionCount + 1 }}</legend>

                            <div class="form-group has-success has-feedback">
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.student_id', $tpgsession['student_id']) }}
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.gcal_event_id', $tpgsession['gcal_event_id']) }}
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.start_time',  $tpgsession['start_time']) }}
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.end_time',  $tpgsession['end_time']) }}
                                <label class="col-sm-1 control-label">Scheduled:</label>
                                <div class="col-sm-3">
                                    {{ Form::text('event[' . $sessionCount . ']' . '.session_daytime_start', Carbon::parse($tpgsession['start_time'])->toDayDateTimeString(), ['class' => 'form-control', 'id' => 'session_datetime['.$sessionCount.']']) }}
                                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                </div>
                                <label class="col-sm-1 control-label">ending</label>
                                <div class="col-sm-2">
                                    {{ Form::text('event[' . $sessionCount . ']' . '.session_time_end', Carbon::parse($tpgsession['end_time'])->format('h:i a'), ['class' => 'form-control', 'id' => 'session_endtime['.$sessionCount.']']) }}
                                    <span class="fa fa-clock-o txt-danger form-control-feedback"></span>
                                </div>
                                <label class="col-sm-1 control-label">Location:</label>
                                <div class="col-sm-2">
                                    {{ Form::text('event[' . $sessionCount . ']' . '.location',  $tpgsession['location'], ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="form-group has-warning has-feedback">
                                {{ Form::label('tutor_scrape', 'with', ['class' => 'col-md-1 control-label']) }}
                                <div class="col-sm-2">
                                    {{ Form::text('event[' . $sessionCount . ']' . '.tutor_unverified',  $tpgsession['tutor_unverified'], ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('test_label', 'tutoring', ['class' => 'col-md-1 control-label']) }}
                                <div class="col-sm-2">
                                    {{ Form::text('event[' . $sessionCount . ']' . '.session_type',  $tpgsession['session_type'], ['class' => 'form-control']) }}
                                </div>
                                {{ Form::label('type_label', 'for the', ['class' => 'col-md-1 control-label']) }}
                                <div class="col-sm-2">
                                    {{ Form::text('event[' . $sessionCount . ']' . '.test_type',  $tpgsession['test_type'], ['class' => 'form-control']) }}
                                </div>
                                {{--<div class="col-sm-2">--}}
                                {{--{{ Form::checkbox('session_check', 'convert_event', true, ['class' => 'fa fa-square-o']) }} convert event--}}
                                {{--</div>--}}
                                <label class="col-sm-1 control-label">tutoring:</label>
                                <div class="col-sm-2">
                                    <div class="toggle-switch toggle-switch-primary">
                                        <label>
                                            {{ Form::checkbox('event[' . $sessionCount . ']' . '.session_check', 'convert_me', true) }}
                                            <div class="toggle-switch-inner"></div>
                                            <div class="toggle-switch-switch"><i class="fa fa-check"></i></div>
                                        </label>
                                    </div>

                                </div>

                                {{ Form::hidden('event[' . $sessionCount . ']' . '.gcal_status',  $tpgsession['gcal_status']) }}
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.gcal_event_id', $tpgsession['gcal_event_id']) }}
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.gcal_event_ical_id', $tpgsession['gcal_event_ical_id']) }}
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.gcal_event_etag', $tpgsession['gcal_event_etag']) }}
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.gcal_html_link', $tpgsession['gcal_html_link']) }}

                                {{--{{{ $tpgsession['summary_raw'] }}}--}}
                            </div>
                            {{-- */$sessionCount++;/* --}}
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

@stop

@section('scripts')
    {{--<script type="text/javascript" src="/bs_dtp/jquery/jquery.min.js"></script>--}}
    <script type="text/javascript" src="/bs_dtp/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="/bs_dtp/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/bs_dtp/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="/assets/js/form2js.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.toObject.js"></script>
    <script type="text/javascript" src="/assets/js/json2.js"></script>
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

        function events2json(evt){
            var startofsession = $('#session_datetime').data("DateTimePicker").getDate();
            alert(startofsession);
            console.log(startofsession);
//            var selector = $('#selector').val(),
//                formDataFirst = $(selector).toObject({mode: 'first'}),
//                formDataAll = $(selector).toObject({mode: 'all'}),
            var formDataCombine = $('#process_event').toObject({mode: 'combine'});

//            $('#testAreaFirst').html(JSON.stringify(formDataFirst, null, '\t'));
//            $('#testAreaAll').html(JSON.stringify(formDataAll, null, '\t'));
            $('#testAreaCombine').html(JSON.stringify(formDataCombine, null, '\t'));
            evt.preventDefault();
        }

        // Run Select2 plugin on elements
        function DemoSelect2(){
            $('#s2_with_tag').select2({placeholder: "Select OS"});
            $('#s2_country').select2();
        }

        $(document).ready(function() {

            //Devoops.js timepicker loader
            //LoadTimePickerScript(AllTimePickers);

            for(var i = 0; i < {{ count($scheduledSessions) }}; i++){
                $('#session_datetime\\['+i+'\\]').datetimepicker();

                $('#session_endtime\\['+i+'\\]').datetimepicker({
                    pickDate: false
                });
            }

            $('input[type=submit]').click(events2json);

            var formData = $('#process_event').serializeObject();
            var result = JSON.stringify(formData);

            $("textarea[name='event-collect']").val(result);
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
            //TinyMCEStart('#wysiwig_full', 'extreme');
            // Add slider for change test input length
            FormLayoutExampleInputLength($( ".slider-style" ));
            // Initialize datepicker
            $('#input_date').datepicker({setDate: new Date()});
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