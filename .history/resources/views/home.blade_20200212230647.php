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
    <div aria-live="polite" aria-atomic="true" class="position-absolute w-100 p-4 d-flex flex-column align-items-end">
        <div class="w-25">
            <div class="toast ml-auto" role="alert" data-delay="1000" data-autohide="true">
                <div class="toast-header">
                    <strong class="mr-auto text-primary">{{ config('app.name') }}</strong>
                    <small class="text-muted">5 mins ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="toast-body">
                    {{ __(Session::get('message')) }}
                </div>
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
