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

@section('body')
    @parent
    @if (Session::has('message'))
    <div aria-live="polite" aria-atomic="true" class="fixed-top" style="top: 36px">
        <div class="toast" style="position: absolute; top: 0; right: 0;" data-delay="{{ (substr_count(trans(Session::get('message')), " ") + 1) * 300 }}">
            <div class="toast-header">
            <img src="..." class="rounded mr-2" alt="...">
            <strong class="mr-auto">{{ config('app.name') }}</strong>
            <small>11 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="toast-body">
                {{ __(Session::get('message')) }}
            </div>
        </div>
    </div>
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
