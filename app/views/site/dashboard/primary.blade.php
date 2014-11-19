@extends('site.layouts.default')

{{-- Calendar Dasboard Build-Step1-Content --}}
@section('content')

<div class="col-md-9 topics-index main-col">
    {{--<div class="panel panel-default">--}}
        <h2>Let's associate calendars with tutors, students, or special events</h2>
        {{ Form::open(['route' => 'dashboard_primary']) }}
            <div class="form-group status-post-submit">
                {{ Form::submit('Post Status',['class' => 'btn btn-default btn-xs']) }}
            </div>
            <div class="row js-trick-container">
                <div class="form-group">

                    @foreach($gCals as $cal)
                        @include('site.dashboard.card', ['cal' => $cal])
                    @endforeach

                </div>
            </div>
        {{ Form::close() }}
    {{--</div>--}}
</div>

@include('site.partials.cal.sidebar', ['currentCals' => $currentCals])

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