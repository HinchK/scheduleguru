@extends('site.layouts.default')

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h2>Let's associate calendars with tutors, students, or special events</h2>
            {{ Form::open(['route' => 'dashboard_primary']) }}

                @foreach($calendars as $cal)
                    {{ Form::hidden('cal_id', $cal->id) }}
                    <div class="row">
                        {{ Form::label($cal->summary)}}
                        {{ Form::select('is a', array('TU' => 'Tutor', 'ST' => 'Student', 'EV' => 'Special Event', 'NA' => 'No association'), 'NA') }}
                    </div>
                @endforeach
                <div class="form-group status-post-submit">
                    {{ Form::submit('Post Status',['class' => 'btn btn-default ']) }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop

@section('scripts')
	<script src="{{ asset('cheaptricks/js/vendor/masonry.pkgd.min.js') }}"></script>
	<script>
        $(function(){$container=$(".js-trick-container");
            $container.masonry({gutter:0,itemSelector:".trick-card",columnWidth:".trick-card"});
            $(".js-goto-trick a").click(function(e){e.stopPropagation()});
            $(".js-goto-trick").click(function(e){e.preventDefault();
            var t="{{ route('dashboard_primary') }}";
            var n=$(this).data("slug");
            window.location=t+"/"+n})})
	</script>
@stop