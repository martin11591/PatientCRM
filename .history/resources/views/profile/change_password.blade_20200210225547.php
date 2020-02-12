@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('profile.change_password') }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('changePassword.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-0 col-md-5 col-lg-4 font-weight-bold">{{ $id }}</div>
                        <div class="col">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
