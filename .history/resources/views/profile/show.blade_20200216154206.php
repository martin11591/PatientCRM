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
                        <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.group") }}: </div>
                        <div class="col">
                        @foreach ($groups as $field) @if (!$loop->first) <br /> @endif {{ __("groups.$field->name") }} @endforeach
                        </div>
                    </div>
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
                        <a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-primary ml-auto mt-4">{{ __('profile.edit') }}</a>
                        @can('delete', $profile)
                        <form method="POST" action="{{ route('profile.delete', $profile) }}">
                        @csrf
                        @method('DELETE')
                            <input type="submit" value="{{ __('profile.delete') }}" class="btn btn-danger ml-2 mt-4" />
                        </form>
                        @endcan
                    </div>{{ __('cancel') }}
                </div>
            </div>
        </div>
    </div>
@endsection
