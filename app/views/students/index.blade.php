@extends('main.layouts.default')
@section('breadcrumbs', Breadcrumbs::render('students'))
@stop

@section('content')
    @include('main.partials.statheader')

    <div class="clearfix">
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="portlet box purple">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-comments"></i>Striped Table
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                        <a href="javascript:;" class="reload"></a>
                        <a href="javascript:;" class="remove"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover">
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
        <div class="col-md-6">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-comments"></i>Student-Calendars
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse"></a>
                        <a href="#portlet-config" data-toggle="modal" class="config"></a>
                        <a href="javascript:;" class="reload"></a>
                        <a href="javascript:;" class="remove"></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    {{--<script src="../../assets/admin/pages/scripts/table-managed.js"></script>--}}
    {{--JS_PLUGINS--}}
    {{ HTML::script('metro/plugins/select2/select2.min.js') }}
    {{ HTML::script('metro/plugins/datatables/media/js/jquery.dataTables.min.js') }}
    {{ HTML::script('metro/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js') }}
    {{--JS_CUSTOM_SCRIPTS--}}
    {{ HTML::script('metro/pages/scripts/table-managed.js') }}
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            if ($('#gcal_importer').size() != 0) {
                $('#gcal_import_loading').hide();
                $('#gcal_import_content').show();
            }

        });
    </script>
@stop
