@extends('site.layouts.gurubase')
{{-- Web site Title --}}
@section('title')
    @parent
    |  Student Index
@stop

@section('content')
    <div class="row">
        <div id="breadcrumb" class="col-xs-12">
            <a href="#" class="show-sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <ol class="breadcrumb pull-left">
                <li>{{ link_to_route('dashboard_primary', 'Dashboard') }}</li>
                <li>{{ link_to_route('dashboard_primary', 'Setup') }}</li>
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
        <br/><br/>
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
                <div class="box-content no-padding">
                    <div class="bs-callout">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <h4>Student Management</h4>
                        <p>The list of current active students</p>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td><a href="{{{ $student->url() }}}">{{ $student->student_id}}</a></td>
                                <td>{{ date($student->created_at) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                        <span>Student-Calendars</span>
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
                    <div class="bs-callout">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <h4>Student Calendar Management</h4>
                        <p><code>.table-striped</code>, <code>.table-bordered</code>, <code>.table-hover</code> and <code>.table-heading</code></p>
                        <p>The list of current active students</p>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-heading no-border-bottom">
                        <thead>
                            <tr>
                                <th>Summary</th>
                                <th>Description</th>
                                <th>ETAG</th>
                                <th>Calendar Link</th>
                                <th>Profile Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentCals as $scal)
                            <tr>
                                <td>{{ $scal->summary }}</td>
                                <td>{{ $scal->description }}</td>
                                <td>{{ $scal->etag }}</td>
                                <td><a href="{{ $scal->cal_id }}">Cal Link</a></td>
                                <td>STATUS - TODO</td>
                            </tr>
                            @endforeach
                            <tr class="active">
                                <td>class</td>
                                <td><code>active</code></td>
                                <td>to</td>
                                <td>color</td>
                                <td>row</td>
                            </tr>
                            <tr class="primary">
                                <td>class</td>
                                <td><code>primary</code></td>
                                <td>to</td>
                                <td>color</td>
                                <td>row</td>
                            </tr>
                            <tr class="success">
                                <td>class</td>
                                <td><code>success</code></td>
                                <td>to</td>
                                <td>color</td>
                                <td>row</td>
                            </tr>
                            <tr class="info">
                                <td>class</td>
                                <td><code>info</code></td>
                                <td>to</td>
                                <td>color</td>
                                <td>row</td>
                            </tr>
                            <tr class="warning">
                                <td>class</td>
                                <td><code>warning</code></td>
                                <td>to</td>
                                <td>color</td>
                                <td>row</td>
                            </tr>
                            <tr class="danger">
                                <td>class</td>
                                <td><code>danger</code></td>
                                <td>to</td>
                                <td>color</td>
                                <td>row</td>
                            </tr>
                            <tr>
                                <td class="active"><code>active</code> class to color cell</td>
                                <td class="success"><code>success</code> class to color cell</td>
                                <td class="info"><code>info</code> class to color cell</td>
                                <td class="warning"><code>warning</code> class to color cell</td>
                                <td class="danger"><code>danger</code> class to color cell</td>
                            </tr>
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
