<div href="#" class="trick-card col-lg-4 col-md-6 col-sm-6 col-xs-12">
	<!--<div class="trick-card-inner js-goto-trick" data-slug="cal-summary-slug">-->
    <div class="trick-card-inner">
		<a class="trick-card-title" href="#">
			{{{  $cal->summary }}}
		</a>
		<div class="trick-card-stats trick-card-by">by <b><a href="#">{{ $cal->summary }}</a></b></div>
		<div class="trick-card-stats clearfix">
			<div class="trick-card-stat-block"><span class="fa fa-eye"></span>{{ $cal->id }}</div>
		</div>
		<div class="trick-card-tags clearfix">
            <div class="btn-group btn-group-sm" id="{{ $cal->id }}">
                <button type="button" class="btn btn-default" value="math">Tutor-Math</button>
                <button type="button" class="btn btn-default">Tutor-Verbal</button>
                <button type="button" class="btn btn-default">Tutor-Both</button>
                <button type="button" class="btn btn-default">Student</button>
                <button type="button" class="btn btn-default">Event Calendar</button>
                <button type="button" class="btn btn-default">Skip this Cal</button>
            </div>
		</div>
	</div>
</div>

