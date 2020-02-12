@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('profile.change_password') }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-9 col-s-8 col-md-7 col-lg-6 col-xl-5 m-auto">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('changePassword.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="row my-2">
                            <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="current_password">{{ __('profile.current_password') }}: </label>
                            <div class="row col">
                                <input id="current_password" name="current_password"  class="form-control row" />@error('current_password')
                                <p class="row text-danger">{{ $errors->first('current_password') }}</p>
                            @enderror
                            </div>
                        </div>
                        @method('PUT')
                        <div class="row my-2">
                            <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="new_password">{{ __('profile.new_password') }}: </label>
                            <div class="row col">
                                <input id="new_password" name="new_password"  class="form-control row" />@error('new_password')
                                <p class="row text-danger">{{ $errors->first('new_password') }}</p>
                            @enderror
                            </div>
                        </div>
                        @method('PUT')
                        <div class="row my-2">
                            <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="repeat_password">{{ __('profile.repeat_password') }}: </label>
                            <div class="row col">
                                <input id="repeat_password" name="repeat_password"  class="form-control row" />@error('repeat_password')
                                <p class="row text-danger">{{ $errors->first('repeat_password') }}</p>
                            @enderror
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
