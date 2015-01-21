@extends('layouts.default')
@section('breadcrumbs', Breadcrumbs::render('studentpage', $student))
@stop

{{-- Web site Title --}}
@section('title')
@parent
   |  {{{ String::title($student->name) }}}
@stop


@section('content')
    <div class="clearfix"></div>
    @if(!$convertedTPGevents)
        <h4>This student has loose events, would you like to create a TPG-Package for them?</h4>
        <a href="{{{ $student->convertpkgURL()  }}}"><p>convert to package</p></a>
    @endif
    <h3>{{ $student->student_id }}</h3>
    <p>FullCal--CalendarID: {{ $student->calendarId }}</p>
    <p>FullCal--GoogleAPIKey: {{ getenv('GOOG_PUB_KEY') }}</p>
    <div class="row">
        <div class="col-md-6 col-sm-6">
           <!--Calendar Box-->`
            <div class="portlet box blue-madison calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-calendar"></i>Calendar for {{{ $student->name }}}
                    </div>
                </div>
                <div class="portlet-body light-grey">
                    <div id="calendar">
                    </div>
                </div>
            </div>
        </div>
        @if (count($events))
            <div class="col-md-6 col-sm-6">
                <div class="portlet box green-haze tasks-widget">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-check"></i>found {{ count($events)  }} events
                        </div>
                        <div class="tools">
                            <a href="#portlet-config" data-toggle="modal" class="config">
                            </a>
                            <a href="" class="reload">
                            </a>
                        </div>
                        <div class="actions">
                            <div class="btn-group">
                                <a class="btn btn-default btn-sm" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    More <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="#">
                                            <i class="i"></i> All Project </a>
                                    </li>
                                    <li class="divider">
                                    </li>
                                    <li>
                                        <a href="#">
                                            AirAsia </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Cruise </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            HSBC </a>
                                    </li>
                                    <li class="divider">
                                    </li>
                                    <li>
                                        <a href="#">
                                            Pending <span class="badge badge-danger">
                                                4 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Completed <span class="badge badge-success">
                                                12 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Overdue <span class="badge badge-warning">
                                                9 </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="task-content">
                            <div class="scroller" style="height: 305px;" data-always-visible="1" data-rail-visible1="1">
                                <ul class="task-list">
                                    @foreach ($events as $event)
                                        @if($event->status != 'cancelled')
                                            <li><div class="task-checkbox">
                                                    <input type="hidden" value="1" name="test"/>
                                                    <input type="checkbox" class="liChild" value="2" name="test"/>
                                                </div>
                                                <div class="task-title">
                                                    <span class="task-title-sp">{{ $event->status }}|<a href="{{ $event->htmlLink }}">{{ $event->getSummary() }}</a>
                                            </span>
                                                    <span class="label label-sm label-success">
                                                        {{{  Carbon::parse($event->getStart()->dateTime,$event->getStart()->timeZone)->toDayDateTimeString() }}}
                                                    </span>
                                                    <span class="task-bell">
                                                        <i class="fa fa-bell-o"></i>
                                                    </span>
                                                </div>
                                                <div class="task-config">
                                                    <div class="task-config-btn btn-group">
                                                        <a class="btn btn-xs default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                                            <i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
                                                        </a>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="#">
                                                                    <i class="fa fa-check"></i> Complete </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <i class="fa fa-pencil"></i> Edit </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    <i class="fa fa-trash-o"></i> Cancel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <!-- END START TASK LIST -->
                            </div>
                        </div>
                        <div class="task-footer">
                            <div class="btn-arrow-link pull-right">
                                <a href="#">See All Records</a>
                                <i class="icon-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop

@section('scripts')
    {{ HTML::script('metro/kjs/gcal.js') }}
    {{ HTML::script('metro/kjs/gfullcal.js') }}
    <script type="text/javascript">
        $(document).ready(function() {
            // Create Calendar
            HalfFullCal('{{ $student->calendarId  }}');
        });
    </script>
@parent
@stop



