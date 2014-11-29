@extends('site.layouts.gurubase')

{{-- Web site Title --}}
@section('title')
{{{ String::title($student->summary) }}} ::
@parent
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
            <p>FullCal--GoogleAPIKey: {{ getenv('GOOG_PUB_KEY') }}</p>
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

                @if (count($events))
                    <h3>found {{ count($events)  }} events</h3>
                    @foreach ($events as $event)
                        <ul>
                            <li>{{ $event->location }}|{{ Carbon::parse($event->getStart()->dateTime,$event->getStart()->timeZone)->toDayDateTimeString() }}: <a href="{{ $event->htmlLink }}">{{ $event->getSummary() }}</a></li>
                        </ul>
                    @endforeach
                @endif

                </div>
            </div>
        </div>


    <div class="row full-calendar">
        <div class="col-sm-3">
            <div id="add-new-event">
                <h4 class="page-header">Add new event</h4>
                <div class="form-group">
                    <label>Event title</label>
                    <input type="text" id="new-event-title" class="form-control">
                </div>
                <div class="form-group">
                    <label>Event description</label>
                    <textarea class="form-control" id="new-event-desc" rows="3"></textarea>
                </div>
                <a href="#" id="new-event-add" class="btn btn-primary pull-right">Add event</a>
                <div class="clearfix"></div>
            </div>
            <div id="external-events">
                <h4 class="page-header" id="events-templates-header">Draggable Events</h4>
                <div class="external-event">Work time</div>
                <div class="external-event">Conference</div>
                <div class="external-event">Meeting</div>
                <div class="external-event">Restaurant</div>
                <div class="external-event">Launch</div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" id="drop-remove"> remove after drop
                        <i class="fa fa-square-o small"></i>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-9">
            <div id="calendar"></div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{ asset('devoops/plugins/fullcalendar/lib/moment.min.js') }}"></script>
    <script src="{{ asset('devoops/plugins/fullcalendar/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('devoops/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('devoops/plugins/fullcalendar/fullcalendar.js') }}"></script>
    <script  src="{{ asset('devoops/plugins/fullcalendar/gcal.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Set Block Height
            SetMinBlockHeight($('#calendar'));
            // Create Calendar
            DrawGoogleFullCal('{{ $student->calendarId  }}');
            //Devoops handy cal draw piece
    //        DrawFullCalendar();
        });
    </script>
@stop



