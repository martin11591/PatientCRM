@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ trans_choice("layout." . ((!isset($empty) || $empty !== true) ? "edit" : "add") . "_{$title}", count($entries) ?? 1) }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ (!isset($empty) || $empty !== true) ? route("{$route}.update", 'post') : route("{$route}.store") }}">
                    @csrf
                    @if (!isset($empty) || $empty !== true)
                        @method('PUT')
                    @endif
                    @foreach ($entries as $entry)
                        @if (!$loop->first)
                        <hr>
                        @endif
                        @foreach ($fields as $field)
                            <div class="row my-2">
                                <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="entry-{{ ($entry->id ?? $loop->parent) }}-{{ $field }}">{{ __("layout.{$title}_$field") }}: </label>
                                <div class="row col">
                                    <input id="entry-{{ ($entry->id ?? $loop->parent) }}-{{ $field }}" name="entry[{{ ($entry->id ?? $loop->parent) }}][{{ $field }}]" value="{{ old("entry[{($entry->id ?? $loop->parent)}][{$field}]") != "" ? old("entry[{($entry->id ?? $loop->parent)}][{$field}]") : $entry->$field }}" class="form-control row" />@error($field)
                                    <p class="row text-danger">{{ $errors->first($field) }}</p>
                                @enderror
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                        <div class="row">
                        @if (isset($empty) && $empty === true)
                            <a href="{{ route("{$route}.create", $amount + 1) }}" class="btn btn-success ml-auto mt-4">{{ __('layout.add') }}</a>
                        @endif
                            <a href="{{ route("{$route}.index") }}" class="btn btn-secondary @if (!isset($empty) || $empty !== true) ml-auto @else ml-2 @endif mt-4">{{ __('layout.cancel') }}</a>
                            <input type="submit" value="{{ __('layout.' . ((!isset($empty) || $empty !== true) ? "update" : "save")) }}" class="btn btn-primary ml-2 mt-4" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
