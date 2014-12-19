@extends('site.layouts.default')
@section('styles')
@parent
<style>

    .trick-card {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .trick-card-title {
        display: block;
        font-weight: bold;
        color: #33383A;
        font-size: 20px;
        padding: 20px;
    }

    .trick-card-title a{
        color: #33383A;
    }

    .trick-card-inner, .content-box {
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
        box-shadow: 0 1px 2px rgba(0,0,0,.15);
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        background-color: #fff;
    }

    .trick-card-inner:hover {
        -webkit-box-shadow: 0 1px 4px rgba(0,0,0,.30);
        -moz-box-shadow: 0 1px 4px rgba(0,0,0,.30);
        box-shadow: 0 1px 4px rgba(0,0,0,.30);
        cursor: pointer;
    }
    .trick-card-inner .fa {
        font-size: 14px;
        margin-right: 5px;
    }
    .trick-card-inner:hover .trick-card-title,
    .trick-card-title a:hover,
    .trick-card-inner:hover .fa {
        color: #FB503B;
    }


    .trick-card-stats, .trick-card-tags {
        width: 100%;
        border-top: #eee 1px solid;
        padding: 10px 20px;
        font-size: 13px;
    }

    .trick-card-stats {
        color: #777;
    }

    .trick-card-timeago {
        display: block;
        color: #999;
        padding-bottom: 5px;
    }

    .trick-card-stat-block {
        height: 20px;
        line-height: 20px;
        float: left;
        width: 33.333%;
    }

    .trick-card-stat-block img {
        vertical-align: top;
        margin-right: 5px;
    }


    .trick-card-by
    {
        border: none;
        padding-top:0;
    }
</style>
@stop
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