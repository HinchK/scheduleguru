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
@endif
