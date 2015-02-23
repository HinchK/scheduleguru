@extends('layouts.default')
@section('breadcrumbs', Breadcrumbs::render('studentpage', $student))
@stop

{{-- Web site Title --}}
@section('title')
    @parent
    |  {{{ String::title($student->name) }}} : Event to Tutoring Session Conversion
@stop

@section('content')
    <div class="clearfix"></div>
    <div class="portlet light bg-inverse">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-equalizer font-red-sunglo"></i>
                <span class="caption-subject font-red-sunglo bold uppercase">Calendar Event Conversion Tool </span>
                <span class="caption-helper"> {{ count($scheduledSessions)  }} events processed</span>
            </div>
            <div class="tools">
                <a href="" class="collapse">
                </a>
                <a href="#portlet-config" data-toggle="modal" class="config">
                </a>
                <a href="" class="reload">
                </a>
                <a href="" class="remove">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            {{ Form::open(['route' => 'convert_package_sessions', 'method' => 'POST', 'class' => 'form-horizontal', 'id' => 'process_event_form', 'role' => 'form' ]) }}
                <div class="form-body">
                    <h2 class="margin-bottom-20"> {{ $student->name }}'s Google Calendar Events </h2>



                    {{-- */$sessionCount = 0;/* --}}

                    <input type="hidden" id="jsonTarget" name="eventsJSON" />
                    {{ Form::hidden('pkgStudentId', $student->id ) }}

                    @foreach($scheduledSessions as $tpgsession)

                        <h3 class="form-section">Event #{{ $sessionCount + 1 }}</h3>
                        {{ Form::hidden('events[' . $sessionCount . ']' . '.student_id', $tpgsession['student_id']) }}
                        {{ Form::hidden('events[' . $sessionCount . ']' . '.gcal_event_id', $tpgsession['gcal_event_id']) }}
                        {{ Form::hidden('events[' . $sessionCount . ']' . '.start_time',  $tpgsession['start_time']) }}
                        {{ Form::hidden('events[' . $sessionCount . ']' . '.end_time',  $tpgsession['end_time']) }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Scheduled</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            {{ Form::text('events[' . $sessionCount . ']' . '.session_daytime_start', Carbon::parse($tpgsession['start_time'])->toDayDateTimeString() . "-" .  Carbon::parse($tpgsession['end_time'])->format('h:i a'), ['class' => 'form-control', 'id' => 'session_datetime['.$sessionCount.']']) }}
                                            {{--{{ Form::text('events[' . $sessionCount . ']' . '.session_time_end', Carbon::parse($tpgsession['end_time'])->format('h:i a'), ['class' => 'form-control', 'id' => 'session_endtime['.$sessionCount.']']) }}--}}
                                            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Location:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            {{ Form::text('events[' . $sessionCount . ']' . '.location',  $tpgsession['location'], ['class' => 'form-control']) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Tutor:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            {{ Form::text('events[' . $sessionCount . ']' . '.tutor_unverified',  $tpgsession['tutor_unverified'], ['class' => 'form-control']) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Tutoring:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            {{ Form::text('events[' . $sessionCount . ']' . '.session_type',  $tpgsession['session_type'], ['class' => 'form-control']) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Target test:</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            {{ Form::text('events[' . $sessionCount . ']' . '.test_type',  $tpgsession['test_type'], ['class' => 'form-control']) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="toggle-switch toggle-switch-primary">
                                        <!--old checkbox style-->
                                        {{--<div class="col-sm-2">--}}
                                        {{--{{ Form::checkbox('session_check', 'convert_event', true, ['class' => 'fa fa-square-o']) }} convert event--}}
                                        {{--</div>--}}
                                        <label>
                                            {{ Form::checkbox('events[' . $sessionCount . ']' . '.session_check', 'convert_me', true) }}
                                            <div class="toggle-switch-inner"></div>
                                            <div class="toggle-switch-switch"><i class="fa fa-check"></i></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::hidden('events[' . $sessionCount . ']' . '.gcal_status',  $tpgsession['gcal_status']) }}
                        {{ Form::hidden('events[' . $sessionCount . ']' . '.gcal_event_ical_id', $tpgsession['gcal_event_ical_id']) }}
                        {{ Form::hidden('events[' . $sessionCount . ']' . '.gcal_event_etag', $tpgsession['gcal_event_etag']) }}
                        {{ Form::hidden('events[' . $sessionCount . ']' . '.gcal_html_link', $tpgsession['gcal_html_link']) }}
                        {{ Form::hidden('events[' . $sessionCount . ']' . '.gcal_event_id', $tpgsession['gcal_event_id']) }}
                        {{ Form::hidden('events[' . $sessionCount . ']' . '.gcal_summary', $tpgsession['summary_raw']) }}
                        {{-- */$sessionCount++;/* --}}
                    @endforeach
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        {{ Form::submit('Convert',['class' => 'btn btn-primary convert-btn']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
@section('scripts')

    {{ HTML::script('metro/plugins/select2/select2.min.js') }}
    {{--{{ HTML::script('metro/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js') }}--}}
    {{--{{ HTML::script('metro/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js') }}--}}
    {{ HTML::script('metro/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
    {{ HTML::script('metro/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js') }}
    {{ HTML::script('metro/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}
    {{ HTML::script('metro/plugins/moment.min.js') }}
    {{ HTML::script('metro/plugins/jquery.mockjax.js') }}
    {{ HTML::script('metro/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js') }}
    {{ HTML::script('metro/plugins/bootstrap-editable/inputs-ext/address/address.js') }}
    {{ HTML::script('metro/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js') }}
    {{ HTML::script('/assets/js/form2js.js') }}
    {{ HTML::script('/assets/js/jquery.toObject.js') }}
    {{ HTML::script('/assets/js/json2.js') }}
   {{ HTML::script('metro/kjs/gcal.js') }}
    {{ HTML::script('metro/kjs/gfullcal.js') }}
    {{ HTML::script('assets/js/metronic.js') }}
    {{ HTML::script('assets/js/convert-events-table.js') }}
    {{ HTML::script('metro/pages/scripts/form-editable.js') }}

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
            var sessStartDT = [];

            for (var i = 0; i < {{ count($scheduledSessions) }}; i++) {
                sessStartDT[i] =  $('#session_datetime\\[' + i + '\\]').data("DateTimePicker").getDate();
            }
            console.log(sessStartDT);
            var formDataCombine = $('#process_event_form').toObject({mode: 'combine'});
            console.log('formDataCombine: ');
            console.log(JSON.stringify(formDataCombine));

//            $('#testAreaFirst').html(JSON.stringify(formDataFirst, null, '\t'));
//            $('#testAreaAll').html(JSON.stringify(formDataAll, null, '\t'));
            $('#testAreaCombine').html(JSON.stringify(formDataCombine, null, '\t'));
            $('#jsonTarget').val(JSON.stringify(formDataCombine, null, '\t'));


        }
        //Testing function...
        function fireObjSerializer(e){
            e.preventDefault();
            var formData = $('#process_event_form').serializeObject();
            var result = JSON.stringify(formData);
            $("textarea[name='event-collect']").val(result);
            $('#event-collecter').val(result);
        }

        // Run Select2 plugin on elements
        function DemoSelect2(){
            $('#s2_with_tag').select2({placeholder: "Select OS"});
            $('#s2_country').select2();
        }

        $(document).ready(function() {

            HalfFullCal('{{ $student->calendar_id  }}');

            for(var i = 0; i < {{ count($scheduledSessions) }}; i++) {
                $('#session_datetime\\['+i+'\\]').datetimepicker();

                $('#session_endtime\\['+i+'\\]').datetimepicker({
                    pickDate: false
                });
            }

//            $('input[type=submit]').click(events2json);
            $('#json-tester').on('click', events2json);

            $('#process_event_form').on('submit', function() {


                var url = $(this).attr('action');
                console.log('url: '+url);
                var data = $(this).toObject({mode: 'combine'});
                $('#jsonTarget').val(JSON.stringify(data));
                console.log('data:**************************\n');
                console.log(data);

                $.post( url,
                        JSON.stringify(data),
                        function($response){
                            console.log($response);
                        },
                        'json'
                );

            });


            // Create Wysiwig editor for textare
            // TinyMCEStart('#wysiwig_simple', null);
            //TinyMCEStart('#wysiwig_full', 'extreme');
            // Add slider for change test input length
//            FormLayoutExampleInputLength($( ".slider-style" ));
            // Initialize datepicker
            $('#input_date').datepicker({setDate: new Date()});
            // Add tooltip to form-controls
            $('.form-control').tooltip();
//            LoadSelect2Script(DemoSelect2);
            // Load example of form validation
//            LoadBootstrapValidatorScript(DemoFormValidator);

            // init metronic core components
            Metronic.init();
            //Convert-Events-Table: adds the little composible boxes to table
            FormEditable.init();

        });
    </script>
@stop
