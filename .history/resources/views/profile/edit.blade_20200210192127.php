@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('profile.profile_data') }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', $profile) }}">
                    @csrf
                    @method('PUT')
                    @isset($user)
                        <div class="row">
                            <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.email") }}: </div>
                            <div class="col">{{ $user->email }}</div>
                        </div>
                    @endisset
                    @foreach ($fields as $field)
                        <div class="row{{ !$loop->first ? " my-2" : "" }}">
                            <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="{{ $field }}">{{ __("profile.$field") }}: </label>
                            <div class="row col">
                                <input id="{{ $field }}" name="{{ $field }}" value="{{ old($field) != "" ? old($field) : $value }}" class="form-control row" />@error($field)
                                <p class="row text-danger">{{ $errors->first($field) }}</p>
                            @enderror
                            </div>
                        </div>
                    @endforeach
                        <div class="row">
                            <input type="submit" value="{{ __('profile.update') }}" class="btn btn-primary ml-auto mt-4" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
