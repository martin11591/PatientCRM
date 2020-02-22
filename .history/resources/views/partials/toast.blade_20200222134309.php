<div aria-live="polite" aria-atomic="true" class="fixed-top" style="top: 72px; margin-right: 16px">
    <div class="toast" style="position: absolute; top: 0; right: 0;" data-delay="{{ (substr_count($slot, ' ') + 1) * 750 }}">
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
</div>