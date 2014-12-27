@extends('site.layouts.gurubase')

{{-- Web site Title --}}
@section('title')
@parent
   |  {{{ String::title($student->name) }}}: convert-package
@stop

@section('styles')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" href="/bs_dtp/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/js/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/js/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/js/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/js/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="/assets/metronic/css/components.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="/assets/metronic/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
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
        <div class="col-sm-4">
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>{{ $student->name  }}'s TPG Package
                    </div>
                </div>
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-search"></i>
                        <span>package data</span>
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
                                <div class="col-sm-11">
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
        <div class="col-sm-12">
            <div class="portlet box red-intense">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>{{ $student->name  }}'s Google Calendar
                    </div>
                </div>
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-search"></i>
                        <span>from Google Calendar Data</span>
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
                    <div class="portlet-body">

                        <table class="table table-striped table-bordered table-hover" id="events_table">
                        <thead>
                            <tr style="background: #353535; color: whitesmoke;">
                                <th>#</th>
                                <th>Test</th>
                                <th>Subject</th>
                                <th>Tutor</th>
                                <th>Scheduled</th>
                                <th>Location</th>
                            </tr>

                        </thead>
                        <tbody>
                            {{-- */$sessionCount = 0;/* --}}
                            {{ Form::open(['route' => 'convert_package_sessions', 'class' => 'form-horizontal', 'id' => 'process_event']) }}
                            @foreach($scheduledSessions as $tpgsession)
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.student_id', $tpgsession['student_id']) }}
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.gcal_event_id', $tpgsession['gcal_event_id']) }}
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.start_time',  $tpgsession['start_time']) }}
                                {{ Form::hidden('event[' . $sessionCount . ']' . '.end_time',  $tpgsession['end_time']) }}
                                <tr>
                                    <td>{{ $sessionCount + 1  }}</td>
                                    <td>{{ Form::text('event[' . $sessionCount . ']' . '.test_type',  $tpgsession['test_type'], ['class' => 'form-control']) }}</td>
                                    <td>{{ Form::text('event[' . $sessionCount . ']' . '.session_type',  $tpgsession['session_type'], ['class' => 'form-control']) }}</td>
                                    <td>{{ Form::text('event[' . $sessionCount . ']' . '.tutor_unverified',  $tpgsession['tutor_unverified'], ['class' => 'form-control']) }}</td>
                                    <td>{{ Form::text('event[' . $sessionCount . ']' . '.session_daytime_start', Carbon::parse($tpgsession['start_time'])->toDayDateTimeString(), ['class' => 'form-control', 'id' => 'session_datetime']) }}</td>
                                    {{--<td>{{ Form::text('event[' . $sessionCount . ']' . '.session_daytime_start', Carbon::parse($tpgsession['start_time'])->toDayDateTimeString(), ['class' => 'form-control', 'id' => 'session_datetime['.$sessionCount.']']) }}</td>--}}
                                    <td>{{ Form::text('event[' . $sessionCount . ']' . '.location',  $tpgsession['location'], ['class' => 'form-control']) }}</td>
                                </tr>
                                {{-- */ $sessionCount++; /* --}}
                            @endforeach
                            {{ Form::close() }}
                        </tbody>

                    </table>
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
                        {{ Form::open(['route' => 'convert_package_sessions', 'class' => 'form-horizontal', 'id' => 'process_event_form']) }}

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
                                {{ Form::button('Convert',['class' => 'btn btn-primary convert-btn', 'data-eventid' => $tpgsession['gcal_event_id'], 'id' => 'convert_events_btn']) }}
                            </div>
                        </div>
                        {{ Form::close() }}

                    @endif

                </div>
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
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="/assets/js/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
    <script type="text/javascript" src="/assets/js/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="/assets/js/metronic.js" type="text/javascript"></script>
    <script type="text/javascript" src="/assets/js/convert-events-table.js"></script>
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
            evt.preventDefault();
            for(var i = 0; i < {{ count($scheduledSessions) }}; i++) {
                console.log($('#session_datetime\\[' + i + '\\]').data("DateTimePicker").getDate());
            }
//            var startofsession = $('#session_datetime').data("DateTimePicker").getDate();
//            alert(startofsession);
//            console.log(startofsession);
//            var selector = $('#selector').val(),
//                formDataFirst = $(selector).toObject({mode: 'first'}),
//                formDataAll = $(selector).toObject({mode: 'all'}),
            var formDataCombine = $('#process_event_form').toObject({mode: 'combine'});
            console.log('formDataCombine: ');
            console.log(formDataCombine);

//            $('#testAreaFirst').html(JSON.stringify(formDataFirst, null, '\t'));
//            $('#testAreaAll').html(JSON.stringify(formDataAll, null, '\t'));
            $('#testAreaCombine').html(JSON.stringify(formDataCombine, null, '\t'));

        }

        // Run Select2 plugin on elements
        function DemoSelect2(){
            $('#s2_with_tag').select2({placeholder: "Select OS"});
            $('#s2_country').select2();
        }

        $(document).ready(function() {

            for(var i = 0; i < {{ count($scheduledSessions) }}; i++) {
                $('#session_datetime\\['+i+'\\]').datetimepicker();

                $('#session_endtime\\['+i+'\\]').datetimepicker({
                    pickDate: false
                });
            }

            $('input[type=submit]').click(events2json);

            var formData = $('#process_event_form').serializeObject();
            var result = JSON.stringify(formData);

            $("textarea[name='event-collect']").val(result);
            $('#event-collecter').val(result);

            $('#convert_events_btn').on('click', function(e){
                e.preventDefault();
                //var eventID = $(this).data('eventdid');
                var url = $('#process_event_form').attr('action');
                var eventData = JSON.stringify($('#process_event_form').toObject({mode: 'combine'}));
                $.ajax({
                   url: url,
                   type: 'POST',
                   data: eventData,
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

            // init metronic core components
            Metronic.init();
            //Convert-Events-Table: adds the little composible boxes to table
            ConvertEventsTable.init();

            // Add drag-n-drop feature to boxes
            WinMove();
        });
    </script>
@stop
