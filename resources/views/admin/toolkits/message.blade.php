<div class="toolkit-alert position-fixed">
    @foreach(['danger', 'warning', 'success', 'info'] as $msg)
        @if(session()->has($msg))
            <div class="alert alert-{{ $msg }}" role="alert">
                <strong>{{ session()->get($msg) }}</strong>
            </div>
        @endif
    @endforeach
</div>
