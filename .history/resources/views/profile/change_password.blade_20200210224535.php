@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('profile.change_password') }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                @isset($user)
                    <div class="row">
                        <div class="mb-0 col-md-5 col-lg-4 font-weight-bold"></div>
                        <div class="col">
                        </div>
                    </div>
                @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
