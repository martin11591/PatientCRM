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
                    <p class="row">
                        <span class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.$field") }}: </span>
                        <span class="col">{{ $value }}</span>
                    </p>
                @endforeach
                @if ($profile['birth'])
                    <p class="row">
                        <span class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.birth") }}: </span>
                        <span class="col">{{ sprintf("%s %s, %s", $profile->birth['zip_code'], $profile->birth['city'], $profile->birth['country']) }}</span>
                    </p>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection
