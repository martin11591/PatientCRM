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
                    <form method="POST" action="profile/data/{{ $profile['user_id'] }}">
                    @csrf
                    @method('PUT')
                    @foreach ($profile as $field => $value)
                    @continue (gettype($value) == "array")
                    @continue ($field == 'user_id')
                        <p class="row">
                            <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="{{ $field }}">{{ __("profile.$field") }}: </label>
                            <input id="{{ $field }}" name="{{ $field }}" value="{{ old($field) != "" ? old($field) : $value }}" class="form-control col" />
                        </p>
                    @endforeach
                    @if (isset($profile['birth']))
                        <p class="row">
                            <span class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.birth") }}: </span>
                            <span class="col">{{ sprintf("%s %s, %s", $profile['birth']['zip_code'], $profile['birth']['city'], $profile['birth']['country']) }}</span>
                        </p>
                    @endif
                    @if (isset($profile['registered']))
                        <p class="row">
                            <span class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.registered") }}: </span>
                            <span class="col">{{ sprintf("%s %s, %s", $profile['registered']['zip_code'], $profile['registered']['city'], $profile['registered']['country']) }}</span>
                        </p>
                    @endif
                    @if (isset($profile['correspondence']))
                        <p class="row">
                            <span class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.correspondence") }}: </span>
                            <span class="col">{{ sprintf("%s %s, %s", $profile['correspondence']['zip_code'], $profile['correspondence']['city'], $profile['correspondence']['country']) }}</span>
                        </p>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
