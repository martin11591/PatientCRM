@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('profile.profile_data') }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', $userProfile) }}">
                    @csrf
                    @method('PUT')
                    @isset($user)
                        <div class="row">
                            <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __("profile.email") }}: </div>
                            <div class="col">{{ $user->email }}</div>
                        </div>
                    @endisset
                    @foreach ($profile as $field => $value)
                    @continue (gettype($value) == "array")
                    @continue ($field == 'user_id')
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
                            <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __('profile.birth') }}: </div>
                            <div class="col">
                                <div class="row">
                                    <label for="birth_zip_code" class="col-4">{{ __('profile.zip_code') }}</label>
                                    <label for="birth_city" class="col-4">{{ __('profile.city') }}</label>
                                    <label for="birth_country" class="col-4">{{ __('profile.country') }}</label>
                                </div>
                                <div class="row">
                                    <input id="birth_zip_code" name="birth_zip_code" value="{{ old('birth_zip_code') != "" ? old('birth_zip_code') : $profile['birth']['zip_code'] }}" class="form-control col-4" />
                                    <input id="birth_city" name="birth_city" value="{{ old('birth_city') != "" ? old('birth_city') : $profile['birth']['city'] }}" class="form-control col-4" />
                                    <input id="birth_country" name="birth_country" value="{{ old('birth_country') != "" ? old('birth_country') : $profile['birth']['country'] }}" class="form-control col-4" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __('profile.registered') }}: </div>
                            <div class="col">
                                <div class="row">
                                    <label for="registered_zip_code" class="col-4">{{ __('profile.zip_code') }}</label>
                                    <label for="registered_city" class="col-4">{{ __('profile.city') }}</label>
                                    <label for="registered_country" class="col-4">{{ __('profile.country') }}</label>
                                </div>
                                <div class="row">
                                    <input id="registered_zip_code" name="registered_zip_code" value="{{ old('registered_zip_code') != "" ? old('registered_zip_code') : $profile['registered']['zip_code'] }}" class="form-control col-4" />
                                    <input id="registered_city" name="registered_city" value="{{ old('registered_city') != "" ? old('registered_city') : $profile['registered']['city'] }}" class="form-control col-4" />
                                    <input id="registered_country" name="registered_country" value="{{ old('registered_country') != "" ? old('registered_country') : $profile['registered']['country'] }}" class="form-control col-4" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ __('profile.correspondence') }}: </div>
                            <div class="col">
                                <div class="row">
                                    <label for="correspondence_zip_code" class="col-4">{{ __('profile.zip_code') }}</label>
                                    <label for="correspondence_city" class="col-4">{{ __('profile.city') }}</label>
                                    <label for="correspondence_country" class="col-4">{{ __('profile.country') }}</label>
                                </div>
                                <div class="row">
                                    <input id="correspondence_zip_code" name="correspondence_zip_code" value="{{ old('correspondence_zip_code') != "" ? old('correspondence_zip_code') : $profile['correspondence']['zip_code'] }}" class="form-control col-4" />
                                    <input id="correspondence_city" name="correspondence_city" value="{{ old('correspondence_city') != "" ? old('correspondence_city') : $profile['correspondence']['city'] }}" class="form-control col-4" />
                                    <input id="correspondence_country" name="correspondence_country" value="{{ old('correspondence_country') != "" ? old('correspondence_country') : $profile['correspondence']['country'] }}" class="form-control col-4" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" value="{{ __('profile.update') }}" class="btn btn-primary ml-auto mt-4" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
