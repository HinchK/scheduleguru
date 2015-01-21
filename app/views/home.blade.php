@extends('layouts.default')

@section('breadcrumbs', Breadcrumbs::render('home'))
@stop

@section('content')

    <!-- DASHBOARD STATS -->
    @include('partials.statheader')
    <!-- END DASHBOARD STATS -->
    <div class="clearfix">
    </div>
    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET -->
            <div class="portlet box yellow">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>Google Calendar Analysis Tool
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                        <a href="#portlet-config" data-toggle="modal" class="config">
                        </a>
                        <a href="javascript:;" class="reload">
                        </a>
                        <a href="javascript:;" class="remove">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <button id="sample_editable_1_new" class="btn green">
                                        Add New <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="#">
                                                Print </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Save as PDF </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                Export to Excel </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div id="site_statistics_loading">--}}
                    <div id="gcal_import_loading">
                        {{--<img src="{{ asset('metro/layout/img/loading.gif')}}" alt="loading"/>--}}
                        {{ HTML::image('metro/layout/img/loading.gif', 'loading', null)  }}
                    </div>
                    <div id="gcal_import_content" class="display-none">
                        <table class="table table-striped table-bordered table-hover" id="gcal_importer">
                            <thead>
                                <tr>
                                    <th class="table-checkbox">
                                        <input type="checkbox" class="group-checkable" data-set="#gcal_importer .checkboxes"/>
                                    </th>
                                    <th>Google Summary</th>
                                    <th>Is a...</th>
                                    <th>Converted</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gCals as $cal)
                                    <tr class="odd gradeX">
                                        <td>
                                            <input type="checkbox" class="checkboxes" value="1"/>
                                        </td>
                                        {{ Form::open(['route' => 'dashboard_primary']) }}
                                        <td>{{ HTML::link('https://www.google.com/calendar/embed?src=' . urlencode($cal['id']), $cal['summary']) }}
                                        </td>
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
                                            <div class="btn-toolbar margin-bottom-10">
                                                <div class="btn-group btn-group-sm btn-group-solid">
                                                    {{ Form::submit('Tutor',['class' => 'btn blue', 'value' =>'TU', 'name' => 'is a']) }}
                                                    {{ Form::submit('Student',['class' => 'btn red', 'value' =>'ST', 'name' => 'is a']) }}
                                                    {{ Form::submit('Events',['class' => 'btn green', 'value' =>'ST', 'name' => 'is a']) }}
                                                </div>
                                            </div>
                                        </td>
                                        {{ Form::close() }}
                                        <td>
                                                <span class="label label-sm label-success">
                                                Approved </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet solid bordered grey-cararra">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bar-chart-o"></i>Site Visits
                    </div>
                    <div class="actions">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn grey-steel btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">New</label>
                            <label class="btn grey-steel btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Returning</label>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="site_statistics_loading">
                        <img src="{{ URL::to('metro/layout/img/loading.gif') }}" alt="loading"/>
                    </div>
                    <div id="site_statistics_content" class="display-none">
                        <div id="site_statistics" class="chart">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet solid grey-cararra bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bullhorn"></i>Revenue
                    </div>
                    <div class="actions">
                        <div class="btn-group pull-right">
                            <a href="" class="btn grey-steel btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                Filter <span class="fa fa-angle-down">
                                    </span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;">
                                        Q1 2014 <span class="label label-sm label-default">
                                            past </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        Q2 2014 <span class="label label-sm label-default">
                                            past </span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="javascript:;">
                                        Q3 2014 <span class="label label-sm label-success">
                                            current </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        Q4 2014 <span class="label label-sm label-warning">
                                            upcoming </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="site_activities_loading">
                        <img src="{{ URL::to('metro/layout/img/loading.gif') }}" alt="loading"/>
                    </div>
                    <div id="site_activities_content" class="display-none">
                        <div id="site_activities" style="height: 228px;">
                        </div>
                    </div>
                    <div style="margin: 20px 0 10px 30px">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                        <span class="label label-sm label-success">
                                        Revenue: </span>
                                <h3>$13,234</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                        <span class="label label-sm label-info">
                                        Tax: </span>
                                <h3>$134,900</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                        <span class="label label-sm label-danger">
                                        Shipment: </span>
                                <h3>$1,134</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                        <span class="label label-sm label-warning">
                                        Orders: </span>
                                <h3>235090</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
    <div class="clearfix">
    </div>
    <div class="row ">
        <div class="col-md-6 col-sm-6">
            <div class="portlet box blue-steel">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-bell-o"></i>Recent Activities
                    </div>
                    <div class="actions">
                        <div class="btn-group">
                            <a class="btn btn-sm btn-default" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                Filter By <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu hold-on-click dropdown-checkboxes pull-right">
                                <label><input type="checkbox"/> Finance</label>
                                <label><input type="checkbox" checked=""/> Membership</label>
                                <label><input type="checkbox"/> Customer Support</label>
                                <label><input type="checkbox" checked=""/> HR</label>
                                <label><input type="checkbox"/> System</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                        <ul class="feeds">
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-info">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                You have 4 pending tasks. <span class="label label-sm label-warning ">
                                                        Take action <i class="fa fa-share"></i>
                                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        Just now
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-success">
                                                    <i class="fa fa-bar-chart-o"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    Finance Report for year 2013 has been released.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            20 mins
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-danger">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                You have 5 pending membership that requires a quick review.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        24 mins
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-info">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                New order received with <span class="label label-sm label-success">
                                                        Reference Number: DR23923 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        30 mins
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                You have 5 pending membership that requires a quick review.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        24 mins
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-default">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
                                                        Overdue </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        2 hours
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-default">
                                                    <i class="fa fa-briefcase"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    IPO Report for year 2013 has been released.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            20 mins
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-info">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                You have 4 pending tasks. <span class="label label-sm label-warning ">
                                                        Take action <i class="fa fa-share"></i>
                                                        </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        Just now
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-danger">
                                                    <i class="fa fa-bar-chart-o"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    Finance Report for year 2013 has been released.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            20 mins
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-default">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                You have 5 pending membership that requires a quick review.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        24 mins
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-info">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                New order received with <span class="label label-sm label-success">
                                                        Reference Number: DR23923 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        30 mins
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-success">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                You have 5 pending membership that requires a quick review.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        24 mins
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-warning">
                                                <i class="fa fa-bell-o"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc">
                                                Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
                                                        Overdue </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="date">
                                        2 hours
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info">
                                                    <i class="fa fa-briefcase"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc">
                                                    IPO Report for year 2013 has been released.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date">
                                            20 mins
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="scroller-footer">
                        <div class="btn-arrow-link pull-right">
                            <a href="#">See All Records</a>
                            <i class="icon-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="portlet box green-haze tasks-widget">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-check"></i>Tasks
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
                            <!-- START TASK LIST -->
                            <ul class="task-list">
                                <li>
                                    <div class="task-checkbox">
                                        <input type="hidden" value="1" name="test"/>
                                        <input type="checkbox" class="liChild" value="2" name="test"/>
                                    </div>
                                    <div class="task-title">
                                                <span class="task-title-sp">
                                                Present 2013 Year IPO Statistics at Board Meeting </span>
                                        <span class="label label-sm label-success">Company</span>
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
                                <li>
                                    <div class="task-checkbox">
                                        <input type="checkbox" class="liChild" value=""/>
                                    </div>
                                    <div class="task-title">
                                                <span class="task-title-sp">
                                                Hold An Interview for Marketing Manager Position </span>
                                        <span class="label label-sm label-danger">Marketing</span>
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
                                <li>
                                    <div class="task-checkbox">
                                        <input type="checkbox" class="liChild" value=""/>
                                    </div>
                                    <div class="task-title">
                                                <span class="task-title-sp">
                                                AirAsia Intranet System Project Internal Meeting </span>
                                        <span class="label label-sm label-success">AirAsia</span>
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
                                <li>
                                    <div class="task-checkbox">
                                        <input type="checkbox" class="liChild" value=""/>
                                    </div>
                                    <div class="task-title">
                                                <span class="task-title-sp">
                                                Technical Management Meeting </span>
                                        <span class="label label-sm label-warning">Company</span>
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
                                <li>
                                    <div class="task-checkbox">
                                        <input type="checkbox" class="liChild" value=""/>
                                    </div>
                                    <div class="task-title">
                                                <span class="task-title-sp">
                                                Kick-off Company CRM Mobile App Development </span>
                                        <span class="label label-sm label-info">Internal Products</span>
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
                                <li>
                                    <div class="task-checkbox">
                                        <input type="checkbox" class="liChild" value=""/>
                                    </div>
                                    <div class="task-title">
                                                <span class="task-title-sp">
                                                Prepare Commercial Offer For SmartVision Website Rewamp </span>
                                        <span class="label label-sm label-danger">SmartVision</span>
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
                                <li>
                                    <div class="task-checkbox">
                                        <input type="checkbox" class="liChild" value=""/>
                                    </div>
                                    <div class="task-title">
                                                <span class="task-title-sp">
                                                Sign-Off The Comercial Agreement With AutoSmart </span>
                                        <span class="label label-sm label-default">AutoSmart</span>
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
                                <li>
                                    <div class="task-checkbox">
                                        <input type="checkbox" class="liChild" value=""/>
                                    </div>
                                    <div class="task-title">
                                                <span class="task-title-sp">
                                                Company Staff Meeting </span>
                                        <span class="label label-sm label-success">Cruise</span>
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
                                <li class="last-line">
                                    <div class="task-checkbox">
                                        <input type="checkbox" class="liChild" value=""/>
                                    </div>
                                    <div class="task-title">
                                                <span class="task-title-sp">
                                                KeenThemes Investment Discussion </span>
                                        <span class="label label-sm label-warning">KeenThemes </span>
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
    </div>
    <div class="clearfix">
    </div>
    <div class="row ">
        <div class="col-md-6 col-sm-6">
            <div class="portlet box purple-wisteria">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-calendar"></i>General Stats
                    </div>
                    <div class="actions">
                        <a href="javascript:;" class="btn btn-sm btn-default easy-pie-chart-reload">
                            <i class="fa fa-repeat"></i> Reload </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="easy-pie-chart">
                                <div class="number transactions" data-percent="55">
                                            <span>
                                            +55 </span>
                                    %
                                </div>
                                <a class="title" href="#">
                                    Transactions <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm">
                        </div>
                        <div class="col-md-4">
                            <div class="easy-pie-chart">
                                <div class="number visits" data-percent="85">
                                            <span>
                                            +85 </span>
                                    %
                                </div>
                                <a class="title" href="#">
                                    New Visits <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm">
                        </div>
                        <div class="col-md-4">
                            <div class="easy-pie-chart">
                                <div class="number bounce" data-percent="46">
                                            <span>
                                            -46 </span>
                                    %
                                </div>
                                <a class="title" href="#">
                                    Bounce <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="portlet box red-sunglo">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-calendar"></i>Server Stats
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
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="sparkline-chart">
                                <div class="number" id="sparkline_bar">
                                </div>
                                <a class="title" href="#">
                                    Network <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm">
                        </div>
                        <div class="col-md-4">
                            <div class="sparkline-chart">
                                <div class="number" id="sparkline_bar2">
                                </div>
                                <a class="title" href="#">
                                    CPU Load <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="margin-bottom-10 visible-sm">
                        </div>
                        <div class="col-md-4">
                            <div class="sparkline-chart">
                                <div class="number" id="sparkline_line">
                                </div>
                                <a class="title" href="#">
                                    Load Rate <i class="icon-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">
    </div>
    <div class="row ">
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN REGIONAL STATS PORTLET-->
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>Regional Stats
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
                <div class="portlet-body">
                    <div id="region_statistics_loading">
                        <img src="{{ URL::to('metro/layout/img/loading.gif') }}" alt="loading"/>
                    </div>
                    <div id="region_statistics_content" class="display-none">
                        <div class="btn-toolbar margin-bottom-10">
                            <div class="btn-group" data-toggle="buttons">
                                <a href="" class="btn default btn-sm active">
                                    Users </a>
                                <a href="" class="btn default btn-sm">
                                    Orders </a>
                            </div>
                            <div class="btn-group pull-right">
                                <a href="" class="btn default btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    Select Region <span class="fa fa-angle-down">
                                        </span>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;" id="regional_stat_world">
                                            World </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" id="regional_stat_usa">
                                            USA </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" id="regional_stat_europe">
                                            Europe </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" id="regional_stat_russia">
                                            Russia </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" id="regional_stat_germany">
                                            Germany </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="vmap_world" class="vmaps display-none">
                        </div>
                        <div id="vmap_usa" class="vmaps display-none">
                        </div>
                        <div id="vmap_europe" class="vmaps display-none">
                        </div>
                        <div id="vmap_russia" class="vmaps display-none">
                        </div>
                        <div id="vmap_germany" class="vmaps display-none">
                        </div>
                    </div>
                </div>
            </div>
            <!-- END REGIONAL STATS PORTLET-->
        </div>
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet paddingless">
                <div class="portlet-title line">
                    <div class="caption">
                        <i class="fa fa-bell-o"></i>Feeds
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
                <div class="portlet-body">
                    <!--BEGIN TABS-->
                    <div class="tabbable tabbable-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1_1" data-toggle="tab">
                                    System </a>
                            </li>
                            <li>
                                <a href="#tab_1_2" data-toggle="tab">
                                    Activities </a>
                            </li>
                            <li>
                                <a href="#tab_1_3" data-toggle="tab">
                                    Recent Users </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1_1">
                                <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible="0">
                                    <ul class="feeds">
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                            <i class="fa fa-bell-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            You have 4 pending tasks. <span class="label label-sm label-danger ">
                                                                    Take action <i class="fa fa-share"></i>
                                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    Just now
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New version v1.4 just lunched!
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        20 mins
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            Database server #12 overloaded. Please fix the issue.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    24 mins
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    30 mins
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    40 mins
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-warning">
                                                            <i class="fa fa-plus"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New user registered.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    1.5 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-success">
                                                            <i class="fa fa-bell-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            Web server hardware needs to be upgraded. <span class="label label-sm label-default ">
                                                                    Overdue </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    2 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    3 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-warning">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    5 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    18 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    21 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    22 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    21 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    22 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    21 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    22 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-default">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    21 hours
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            New order received. Please take care of it.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    22 hours
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_1_2">
                                <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
                                    <ul class="feeds">
                                        <li>
                                            <a href="#">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New user registered
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New order received
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        10 mins
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc">
                                                            Order #24DOP4 has been rejected. <span class="label label-sm label-danger ">
                                                                    Take action <i class="fa fa-share"></i>
                                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col2">
                                                <div class="date">
                                                    24 mins
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New user registered
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New user registered
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New user registered
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New user registered
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New user registered
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New user registered
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc">
                                                                New user registered
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date">
                                                        Just now
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_1_3">
                                <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible1="1">
                                    <div class="row">
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Robert Nilson </a>
                                                            <span class="label label-sm label-success label-mini">
                                                            Approved </span>
                                                </div>
                                                <div>
                                                    29 Jan 2013 10:45AM
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}"  class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Lisa Miller </a>
                                                            <span class="label label-sm label-info">
                                                            Pending </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 10:45AM
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Eric Kim </a>
                                                            <span class="label label-sm label-info">
                                                            Pending </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 12:45PM
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Lisa Miller </a>
                                                            <span class="label label-sm label-danger">
                                                            In progress </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 11:55PM
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Eric Kim </a>
                                                            <span class="label label-sm label-info">
                                                            Pending </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 12:45PM
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Lisa Miller </a>
                                                            <span class="label label-sm label-danger">
                                                            In progress </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 11:55PM
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Eric Kim </a>
                                                            <span class="label label-sm label-info">
                                                            Pending </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 12:45PM
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Lisa Miller </a>
                                                            <span class="label label-sm label-danger">
                                                            In progress </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 11:55PM
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Eric Kim </a>
                                                            <span class="label label-sm label-info">
                                                            Pending </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 12:45PM
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Lisa Miller </a>
                                                            <span class="label label-sm label-danger">
                                                            In progress </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 11:55PM
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Eric Kim </a>
                                                            <span class="label label-sm label-info">
                                                            Pending </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 12:45PM
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 user-info">
                                            <img alt="" src="{{ URL::to('metro/layout/img/avatar.png') }}" class="img-responsive"/>
                                            <div class="details">
                                                <div>
                                                    <a href="#">
                                                        Lisa Miller </a>
                                                            <span class="label label-sm label-danger">
                                                            In progress </span>
                                                </div>
                                                <div>
                                                    19 Jan 2013 11:55PM
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END TABS-->
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
    <div class="clearfix">
    </div>
    <div class="row ">
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet box blue-madison calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-calendar"></i>Calendar
                    </div>
                </div>
                <div class="portlet-body light-grey">
                    <div id="calendar">
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet">
                <div class="portlet-title line">
                    <div class="caption">
                        <i class="fa fa-comments"></i>Chats
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
                <div class="portlet-body" id="chats">
                    <div class="scroller" style="height: 435px;" data-always-visible="1" data-rail-visible1="1">
                        <ul class="chats">
                            <li class="in">
                                <img class="avatar" alt="" src="{{ URL::to('metro/layout/img/avatar1.jpg') }}"/>
                                <div class="message">
                                            <span class="arrow">
                                            </span>
                                    <a href="#" class="name">
                                        Bob Nilson </a>
                                            <span class="datetime">
                                            at 20:09 </span>
                                            <span class="body">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                </div>
                            </li>
                            <li class="out">
                                <img class="avatar" alt="" src="{{ URL::to('metro/layout/img/avatar2.jpg') }}"/>
                                <div class="message">
                                            <span class="arrow">
                                            </span>
                                    <a href="#" class="name">
                                        Lisa Wong </a>
                                            <span class="datetime">
                                            at 20:11 </span>
                                            <span class="body">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                </div>
                            </li>
                            <li class="in">
                                <img class="avatar" alt="" src="{{ URL::to('metro/layout/img/avatar1.jpg') }}"/>
                                <div class="message">
                                            <span class="arrow">
                                            </span>
                                    <a href="#" class="name">
                                        Bob Nilson </a>
                                            <span class="datetime">
                                            at 20:30 </span>
                                            <span class="body">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                </div>
                            </li>
                            <li class="out">
                                <img class="avatar" alt="" src="{{ URL::to('metro/layout/img/avatar3.jpg') }}"/>
                                <div class="message">
                                            <span class="arrow">
                                            </span>
                                    <a href="#" class="name">
                                        Richard Doe </a>
                                            <span class="datetime">
                                            at 20:33 </span>
                                            <span class="body">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                </div>
                            </li>
                            <li class="in">
                                <img class="avatar" alt="" src="{{ URL::to('metro/layout/img/avatar3.jpg') }}"/>
                                <div class="message">
                                            <span class="arrow">
                                            </span>
                                    <a href="#" class="name">
                                        Richard Doe </a>
                                            <span class="datetime">
                                            at 20:35 </span>
                                            <span class="body">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                </div>
                            </li>
                            <li class="out">
                                <img class="avatar" alt="" src="{{ URL::to('metro/layout/img/avatar1.jpg') }}"/>
                                <div class="message">
                                            <span class="arrow">
                                            </span>
                                    <a href="#" class="name">
                                        Bob Nilson </a>
                                            <span class="datetime">
                                            at 20:40 </span>
                                            <span class="body">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                </div>
                            </li>
                            <li class="in">
                                <img class="avatar" alt="" src="{{ URL::to('metro/layout/img/avatar3.jpg') }}"/>
                                <div class="message">
                                            <span class="arrow">
                                            </span>
                                    <a href="#" class="name">
                                        Richard Doe </a>
                                            <span class="datetime">
                                            at 20:40 </span>
                                            <span class="body">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                </div>
                            </li>
                            <li class="out">
                                <img class="avatar" alt="" src="{{ URL::to('metro/layout/img/avatar1.jpg') }}"/>
                                <div class="message">
                                            <span class="arrow">
                                            </span>
                                    <a href="#" class="name">
                                        Bob Nilson </a>
                                            <span class="datetime">
                                            at 20:54 </span>
                                            <span class="body">
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. sed diam nonummy nibh euismod tincidunt ut laoreet. </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="chat-form">
                        <div class="input-cont">
                            <input class="form-control" type="text" placeholder="Type a message here..."/>
                        </div>
                        <div class="btn-cont">
                                    <span class="arrow">
                                    </span>
                            <a href="" class="btn blue icn-only">
                                <i class="fa fa-check icon-white"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
@stop
@section('scripts')
    {{--<script src="../../assets/admin/pages/scripts/table-managed.js"></script>--}}
    {{--JS_PLUGINS--}}
    {{ HTML::script('metro/plugins/jqvmap/jqvmap/jquery.vmap.js') }}
    {{ HTML::script('metro/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}
    {{ HTML::script('metro/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}
    {{ HTML::script('metro/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}
    {{ HTML::script('metro/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}
    {{ HTML::script('metro/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}
    {{ HTML::script('metro/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}
    {{ HTML::script('metro/plugins/select2/select2.min.js') }}
    {{ HTML::script('metro/plugins/datatables/media/js/jquery.dataTables.min.js') }}
    {{ HTML::script('metro/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}
    {{--JS_CUSTOM_SCRIPTS--}}
    {{ HTML::script('metro/pages/scripts/table-managed.js') }}
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            Index.initJQVMAP(); // init index page's custom scripts
            Index.initCharts(); // init index page's custom scripts
            Index.initChat();
            Index.initMiniCharts();
            Index.initIntro();
            Tasks.initDashboardWidget();
            Index.initCalendar(); // init index page's custom scripts
            if ($('#gcal_importer').size() != 0) {
                $('#gcal_import_loading').hide();
                $('#gcal_import_content').show();
            }

        });
    </script>
@stop
