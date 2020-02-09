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
                @continue (gettype($value) == "array")
                    <div class="row">
                        <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.$field") }}: </div>
                        <div class="col">{{ $value }}</div>
                    </div>
                @endforeach
                @if (isset($profile['birth']))
                    <div class="row">
                        <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.birth") }}: </div>
                        <div class="col">{{ sprintf("%s %s, %s", $profile['birth']['zip_code'], $profile['birth']['city'], $profile['birth']['country']) }}</div>
                    </div>
                @endif
                @if (isset($profile['registered']))
                    <div class="row">
                        <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.registered") }}: </div>
                        <div class="col">{{ sprintf("%s %s, %s", $profile['registered']['zip_code'], $profile['registered']['city'], $profile['registered']['country']) }}</div>
                    </div>
                @endif
                @if (isset($profile['correspondence']))
                    <div class="row">
                        <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.correspondence") }}: </div>
                        <div class="col">{{ sprintf("%s %s, %s", $profile['correspondence']['zip_code'], $profile['correspondence']['city'], $profile['correspondence']['country']) }}</div>
                    </div>
                @endif
                    <div class="row">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary ml-auto mt-4">{{ __('profile.edit') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
