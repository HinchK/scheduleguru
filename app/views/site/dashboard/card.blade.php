<div href="#" class="trick-card col-lg-4 col-md-6 col-sm-6 col-xs-12">
	<!--<div class="trick-card-inner js-goto-trick" data-slug="cal-summary-slug">-->
    <div class="trick-card-inner">
		<a class="trick-card-title" href="#">
			{{{  $cal['summary'] }}}
		</a>
		<div class="trick-card-stats trick-card-by">GoogleID: <b><a href="#">{{ $cal['id'] }}</a></b></div>
		<div class="trick-card-stats clearfix">
			<div class="trick-card-stat-block">
			    <span class="fa fa-eye"></span>
			</div>
		</div>
		<div class="trick-card-tags clearfix">
            {{ Form::open(['route' => 'dashboard_primary']) }}

                {{ Form::hidden('cal_id', $cal['id']) }}
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

                {{ Form::select('is a', array('TU' => 'Tutor', 'ST' => 'Student', 'EV' => 'Special Event', 'NA' => 'No association'), 'NA') }}

                {{ Form::submit('Apply',['class' => 'btn btn-default ']) }}
            {{ Form::close() }}
		</div>
		<div class="panel panel-danger">{{ $cal['description'] }}</div>
	</div>
</div>

