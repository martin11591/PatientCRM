@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('profile.profile_data') }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                @foreach ($profile as $field => $value)
                    <p class="mb-0">
                        <span class="col-6">{{ $field }}: </span>
                        <span class="col-6">{{ $value }}</span>
                    </p>
                @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
