<div class="navbar navbar-default navbar-inverse navbar-fixed-top">
     <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li {{ (Request::is('/') ? ' class="active"' : '') }}><a href="{{{ URL::to('') }}}">Home</a></li>
            </ul>

            <ul class="nav navbar-nav pull-right">
                @if (Auth::check())
                @if (Auth::user()->hasRole('admin'))
                <li {{ (Request::is('google/dash') ? ' class="active"' : '') }}><a href="{{{ URL::to('google/dash') }}}">Calendar Dashboard</a></li>
                @endif
                <li><a href="{{{ URL::to('user') }}}">Logged in as {{{ Auth::user()->username }}}</a></li>
                <li><a href="{{{ URL::to('user/logout') }}}">Logout</a></li>
                @else
                <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                <li {{ (Request::is('user/create') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/create') }}}">{{{ Lang::get('site.sign_up') }}}</a></li>
                <li {{ (Request::is('google') ? ' class="active"' : '') }}><a href="{{{ URL::to('google') }}}">SuperUser</a></li>
                @endif
            </ul>
            <!-- ./ nav-collapse -->
        </div>
    </div>
</div>