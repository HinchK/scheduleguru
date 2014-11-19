<div class="col-md-3 side-bar" style="padding-top: 15px;">

    <div class="panel panel-default corner-radius" >

        <div class="panel-heading text-center">
        <h3 class="panel-title">Current Calendar-Relations</h3>
        </div>

        <div class="panel-body text-center">
            <div class="btn-group">
                <a href="/tutors" class="btn btn-success btn-lg">
                  {{--{{ isset($node) ? URL::route('topics.create', ['node_id' => $node->id]) : URL::route('topics.create') ; }}--}}

                  <i class="glyphicon glyphicon-pencil"> </i> Tutors: {{ count($currentCals) }}
                </a>
            </div>
        </div>
    </div>

    @if (isset($currentCals) && count($currentCals))
        <div class="panel panel-default corner-radius">
            <div class="panel-heading text-center">
                <h3 class="panel-title">Currently Known Calendars</h3>
            </div>
            <div class="panel-body text-center" style="padding-top: 5px;">
                @foreach ($currentCals as $current)
                    <p> {{{ $current->cal_id }}} , {{{ $current->is_a }}} </p>
                    {{--<a href="{{ $link->link }}" target="_blank" rel="nofollow" title="{{ $link->title }}">--}}
                        {{--<img src="{{ $link->cover }}" style="width:150px; margin: 3px 0;">--}}
                    {{--</a>--}}
                @endforeach
            </div>
        </div>
    @endif

    <div class="panel panel-default corner-radius">
        <div class="panel-heading text-center">
            <h3 class="panel-title">'Learning Resources'</h3>
        </div>
        <div class="panel-body">
            <ul class="list">
                <li><a href="http://laravel-china.org/">Laravel 4.2</a></li>
                <li><a href="http://wulijun.github.io/php-the-right-way/">PHP The Right Way</a></li>
                <li><a href="https://github.com/PizzaLiu/PHP-FIG">PHP-FIG</a></li>
                <li><a href="http://www.phpcomposer.com/">Composer</a></li>
            </ul>
        </div>
    </div>



    <div class="panel panel-default corner-radius">
        <div class="panel-heading text-center">
          <h3 class="panel-title">'Tips and Tricks</h3>
        </div>
        <div class="panel-body">
            tips and tricks body
        </div>
    </div>


    <div class="panel panel-default corner-radius">
        <div class="panel-heading text-center">
          <h3 class="panel-title">Site Status</h3>
        </div>
        <div class="panel-body">
            <ul>
            <li>more </li>
            <li>stuff</li>
            <li>options</li>
            </ul>
        </div>
    </div>

</div>
<div class="clearfix"></div>