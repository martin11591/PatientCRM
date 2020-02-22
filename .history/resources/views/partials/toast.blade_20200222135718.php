<div class="toast" data-delay="{{ $duration ?? (substr_count($slot, ' ') + 1) * ($wordDuration ?? 750) }}">
    <div class="toast-header">
    {{--<img src="..." class="rounded mr-2" alt="...">--}}
    <strong class="mr-auto">{{ config('app.name') }}</strong>
    <small class="ml-2">{{ date("G:i:s") }}</small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="toast-body">
        {!! $slot !!}
    </div>
</div>