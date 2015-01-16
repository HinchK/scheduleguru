@if ($breadcrumbs)
    <ul class="page-breadcrumb">
        @foreach ($breadcrumbs as $breadcrumb)
            @if($breadcrumb->first)
                <i class="fa fa-home"></i>
            @endif
            @if (!$breadcrumb->last)
                <li><a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a></li>
                <i class="fa fa-angle-right"></i>
            @else
                {{--<li class="active">{{{ $breadcrumb->title }}}</li>--}}
                <li>{{{ $breadcrumb->title }}}</li>
            @endif
        @endforeach
    </ul>
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->last && $breadcrumb->title == 'home')
            <div class="page-toolbar">
                <div id="dashboard-report-range" class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="Change dashboard date range">
                    <i class="icon-calendar"></i>&nbsp; <span class="thin uppercase visible-lg-inline-block"></span>&nbsp; <i class="fa fa-angle-down"></i>
                </div>
            </div>
        @endif
    @endforeach
@endif

