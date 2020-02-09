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
                @php (dd($user))
                @foreach ($profile as $field => $value)
                    @continue ($field == 'user_id')
                    @if ($value != null)
                    <p class="row">
                        <span class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.$field") }}: </span>
                        <span class="col">{{ $value }}</span>
                    </p>
                    @endif
                @endforeach
                    <p>
                        <span class="col-6">{{ $birth_place }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
