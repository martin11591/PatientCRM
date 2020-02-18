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
                        <div class="row my-2">
                            <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="email">{{ __("profile.email") }}: </label>
                            <div class="row col">
                                <input id="email" name="email" value="{{ old('email') != "" ? old('email') : $user->email }}" class="form-control row" />@error('email')
                                <p class="row text-danger">{{ $errors->first('email') }}</p>
                            @enderror
                            </div>
                        </div>
                    @endisset
                    @foreach ($fields as $field)
                        <div class="row my-2">
                            <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="{{ $field }}">{{ __("profile.$field") }}: </label>
                            <div class="row col">
                                <input id="{{ $field }}" name="{{ $field }}" value="{{ old($field) != "" ? old($field) : $profile->$field }}" class="form-control row" />@error($field)
                                <p class="row text-danger">{{ $errors->first($field) }}</p>
                            @enderror
                            </div>
                        </div>
                    @endforeach
                        <div class="row">
                            <a href="{{ route('profile.show', $profile) }}" class="btn btn-primary ml-auto mt-4">{{ __('profile.cancel') }}</a>
                            <input type="submit" value="{{ __('profile.update') }}" class="btn btn-primary ml-2 mt-4" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                            @include('partials.modal_button', ['btn-target' => '#test1'])
                            @include('partials.modal_content', ['modal_title' => 'test', 'modal_content' => 'test'])
@endsection
