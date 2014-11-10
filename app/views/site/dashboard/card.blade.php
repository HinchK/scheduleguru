<div href="#" class="trick-card col-lg-4 col-md-6 col-sm-6 col-xs-12">
	<!--<div class="trick-card-inner js-goto-trick" data-slug="cal-summary-slug">-->
    <div class="trick-card-inner">
		<a class="trick-card-title" href="#">
			{{{  $cal->summary }}}
		</a>
		<div class="trick-card-stats trick-card-by">by <b><a href="#">{{ $cal->summary }}</a></b></div>
		<div class="trick-card-stats clearfix">
			<div class="trick-card-stat-block">
			    <span class="fa fa-eye"></span>{{ $cal->description }}
			</div>
		</div>
		<div class="trick-card-tags clearfix">
            {{ Form::open(['route' => 'dashboard_primary']) }}
                {{ Form::hidden('cal_id', $cal->id) }}
                {{ Form::hidden('cal_summary', $cal->summary) }}
                {{ Form::hidden('cal_bg_color', $cal->backgroundColor) }}
                {{ Form::select('is a', array('TU' => 'Tutor', 'ST' => 'Student', 'EV' => 'Special Event', 'NA' => 'No association'), 'NA') }}
                {{ Form::submit('Apply',['class' => 'btn btn-default ']) }}
            {{ Form::close() }}
		</div>
	</div>
</div>

