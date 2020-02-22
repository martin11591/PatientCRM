@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@if (Session::has('messages') || isset($messages))
    @section('body')
        @parent
        {{--<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">--}}
            <div style="position: absolute; top: 0; right: 0;">
            @if (Session::has('messages'))
                @foreach (Session::get('message') as $message)
                    @component('partials.toast')
                        {!! $message !!}
                    @endcomponent
                @endforeach
            @elseif (isset($messages))
                @foreach ($messages as $message)
                    @component('partials.toast')
                        {!! $message !!}
                    @endcomponent
                @endforeach
            @endif
            </div>
        {{--</div>--}}
    @endsection

    @section('adminlte_js')
        @parent
        <script type="text/javascript">
            $(document).ready(function() {
                var toasts = $('.toast');
                toasts.toast('show');
            });
        </script>
    @endsection
@endif
