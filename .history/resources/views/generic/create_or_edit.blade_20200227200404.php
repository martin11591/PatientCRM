@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ trans_choice("layout.edit_{$title}", count($entries) ?? 1) }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route("{$route}.update", 'post') }}">
                    @csrf
                    @method('PUT')
                    @foreach ($entries as $entry)
                        @if (!$loop->first)
                        <hr>
                        @endif
                        @foreach ($fields as $field)
                            <div class="row my-2">
                                <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="entry-{{ $entry->id }}-{{ $field }}">{{ __("layout.{$title}_$field") }}: </label>
                                <div class="row col">
                                    <input id="entry-{{ $entry->id }}-{{ $field }}" name="entry[{{ $entry->id }}][{{ $field }}]" value="{{ old("entry[{$entry->id}][{$field}]") != "" ? old("entry[{$entry->id}][{$field}]") : $entry->$field }}" class="form-control row" />@error($field)
                                    <p class="row text-danger">{{ $errors->first($field) }}</p>
                                @enderror
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                        <div class="row">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary ml-auto mt-4">{{ __('layout.cancel') }}</a>
                            <input type="submit" value="{{ __('layout.{$action}') }}" class="btn btn-primary ml-2 mt-4" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
