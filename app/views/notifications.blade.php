@if (count($errors->all()) > 0)
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4>Error</h4>
	Please check the form below for errors
</div>
@endif

@if ($message = Session::get('success'))
    @if(is_array($message))
        @foreach ($message as $m)
            <script>
            $(document).ready(function () {
                $.notific8('{{ $m }}', {
                    heading: 'Success!',
                    theme: 'amethyst',
                    life: '5000'
                });
            }
            </script>
        @endforeach
    @else
        <script>
        $(document).ready(function () {
            $.notific8('{{ $message }}', {
                heading: 'Success!',
                theme: 'amethyst',
                life: '5000'
            });
        }
        </script>
    @endif
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4>Error</h4>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h4>Warning</h4>
    @if(is_array($message))
    @foreach ($message as $m)
    {{ $m }}
    @endforeach
    @else
    {{ $message }}
    @endif
</div>
@endif

@if ($message = Session::get('info'))
    <script>
    @if(is_array($message))
        @foreach ($message as $m)
            $.notific8('{{ $m }}', {
                heading: 'INFO!',
                theme: 'tangerine',
                sticky: true,
                zindex: '500',
                verticalEdge: 'left',
                horizontalEdge: 'bottom'
            });
             $.notific8('zindex', 11500);
        @endforeach
    @else
        $.notific8('{{ $message }}', {
            heading: 'Welcome!',
            theme: 'tangerine',
            sticky: true,
            verticalEdge: 'left',
            horizontalEdge: 'bottom'
        });
        $.notific8('zindex', 11500);
    @endif
    </script>
@endif