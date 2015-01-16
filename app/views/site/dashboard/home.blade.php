@extends('site.layouts.gurubase')

@section('content')
    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li>{{ link_to_route('dashboard_primary', 'Dashboard') }}</li>
                <li>{{ link_to_route('dashboard_primary', 'Setup') }}</li>
                <li><a href="#">Sort Google Calendar Data</a></li>
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
            <h3>Dashboard Setup</h3>
            <h4>Student Management</h4>
        </div>
        <div class="clearfix visible-xs"></div>
        <div class="col-xs-12 col-sm-8 col-md-7 pull-right">
            <div class="row">
                <div class="col-xs-4">
                    <a href="/guru/tutors" class="btn btn-success btn-lg">
                    <i class="fa fa-user"> </i> Tutors: {{ count($tutorCals) }}
                    </a>
                </div>
                <div class="col-xs-4">
                    <a href="/guru/students" class="btn btn-success btn-lg">
                    <i class="fa fa-pencil"> </i> Students: {{ count($studentCals) }}
                    </a>
                </div>
                <div class="col-xs-4">
                    <div class="sparkline-dashboard" id="sparkline-3"></div>
                    <div class="sparkline-dashboard-info">
                        <i class="fa fa-usd"></i>107.83M
                        <span>Appointments</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <h4>{{ link_to_route('student_management', 'Student Management') }}</h4>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h4>{{ link_to_route('tutor_management', 'Tutor Management') }}</h4>
        </div>
        <div class="col-xs-12 col-sm-4">
            <h4>{{ link_to_route('event_management', 'Event Management') }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-table"></i>
                        <span>Found Unclassified Google Calendars</span>
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
                <div class="box-content no-padding">
                    <table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
                        <thead>
                            <tr>
                                <th>Summary</th>
                                <th>Google ID</th>
                                <th>Is a...</th>
                                <th>Converted</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($gCals as $cal)
                            <tr>
                                {{ Form::open(['route' => 'dashboard_primary']) }}
                                <td>{{{ $cal['summary'] }}}</td>
                                <td>{{{ $cal['id'] }}}</td>
                                <td>{{ Form::hidden('cal_id', $cal['id']) }}
                                    {{ Form::hidden('accessRole', $cal['accessRole']) }}
                                    {{ Form::hidden('backgroundColor', $cal['backgroundColor']) }}
                                    {{ Form::hidden('colorId', $cal['colorId']) }}
                                    {{ Form::hidden('deleted', $cal['deleted']) }}
                                    {{ Form::hidden('description', $cal['description']) }}
                                    {{ Form::hidden('etag', $cal['etag']) }}
                                    {{ Form::hidden('foregroundColor', $cal['foregroundColor']) }}
                                    {{ Form::hidden('hidden', $cal['hidden']) }}
                                    {{ Form::hidden('kind', $cal['kind']) }}
                                    {{ Form::hidden('location', $cal['location']) }}
                                    {{ Form::hidden('primary', $cal['primary']) }}
                                    {{ Form::hidden('selected', $cal['selected']) }}
                                    {{ Form::hidden('summary', $cal['summary']) }}
                                    {{ Form::hidden('summaryOverride', $cal['summaryOverride']) }}
                                    {{ Form::hidden('timeZone', $cal['timeZone']) }}
                                    {{ Form::submit('Tutor',['class' => 'tag btn-warning', 'value' =>'TU', 'name' => 'is a']) }}
                                    {{ Form::submit('Student',['class' => 'tag btn-primary', 'value' =>'ST', 'name' => 'is a']) }}
                                    {{ Form::submit('Events',['class' => 'tag btn-default', 'value' =>'ST', 'name' => 'is a']) }}</td>
                                {{ Form::close() }}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-table"></i>
                        <span>Students</span>
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
                    <p>Use <code>.table-striped</code> to add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>.</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="hidden">{{{ $stotal = 1 }}}</div>

                            @foreach($currentCals as $ccal)
                                <tr>
                                    @if($ccal->is_a == 'Student')
                                        <td>{{{ $stotal++ }}}</td>
                                        <td>{{{ $ccal->summary }}}</td>
                                        <td>{{{ $ccal->created_at }}}</td>
                                        <td>{{{ $ccal->description }}}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <div class="box">
                <div class="box-header">
                    <div class="box-name">
                        <i class="fa fa-table"></i>
                        <span>Tutors</span>
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
                    <p>Use <code>.table-striped</code> to add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>.</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Created</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="hidden">{{{ $ttotal = 1 }}}</div>

                            @foreach($currentCals as $ccal)
                                <tr>
                                    @if($ccal->is_a == 'Tutor')
                                        <td>{{{ $ttotal++ }}}</td>
                                        <td>{{{ $ccal->summary }}}</td>
                                        <td>{{{ $ccal->created_at }}}</td>
                                        <td>{{{ $ccal->description }}}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
    $(document).ready(function() {
        // Drag-n-Drop feature
        WinMove();
    });
    </script>
@stop
