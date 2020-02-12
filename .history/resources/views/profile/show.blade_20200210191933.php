@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('profile.profile_data') }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                @isset($user)
                    <div class="row">
                        <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.email") }}: </div>
                        <div class="col">{{ $user->email }}</div>
                    </div>
                @endisset
                @foreach ($fields as $field)
                    <div class="row">
                        <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.$field") }}: </div>
                        <div class="col">{{ $profile->$field }}</div>
                    </div>
                @endforeach
                    <div class="row">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary ml-auto mt-4">{{ __('profile.edit') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
