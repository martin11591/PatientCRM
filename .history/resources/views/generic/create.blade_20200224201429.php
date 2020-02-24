@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ trans_choice("layout.add_{$title}", $amount ?? 1) }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route("{$route}.store") }}">
                    @csrf
                    @for ($index = 1; $index <= $amount; $index++)
                        @foreach ($fields as $field)
                            <div class="row my-2">
                                <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="entry-{{ $index }}-{{ $field }}">{{ __("layout.{$title}_$field") }}: </label>
                                <div class="row col">
                                    <input id="entry-{{ $index }}-{{ $field }}" name="entry[][{{ $field }}]" value="{{ old("entry[][{$field}]") ?? "" }}" class="form-control row" />@error($field)
                                    <p class="row text-danger">{{ $errors->first($field) }}</p>
                                @enderror
                                </div>
                            </div>
                        @endforeach
                    @endfor
                        <div class="row">
                            <a href="{{ route("{$route}.create", $amount + 1) }}" class="btn btn-success ml-auto mt-4">{{ __('layout.add') }}</a>
                            <a href="{{ route("{$route}.index") }}" class="btn btn-secondary ml-2 mt-4">{{ __('layout.cancel') }}</a>
                            <input type="submit" value="{{ __('layout.save') }}" class="btn btn-primary ml-2 mt-4" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
