@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('layout.edit_entry') }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('disease.update', 'post') }}">
                    @csrf
                    @method('PUT')
                    @foreach ($entries as $id => $entry)
                        @if (!$loop->first)
                        <hr>
                        @endif
                        @foreach ($fields as $key => $field)
                            <div class="row my-2">
                                @if (gettype($field) != "array")
                                <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="entry-{{ $id }}-{{ $field }}">{{ __("layout.disease_$field") }}: </label>
                                <div class="row col">
                                    <input id="entry-{{ $id }}-{{ $field }}" name="entry[{{ $id }}][{{ $field }}]" value="{{ old("entry[{$id}][{$field}]") != "" ? old("entry[{$id}][{$field}]") : $entry->$field }}" class="form-control row" />@error($field)
                                    <p class="row text-danger">{{ $errors->first($field) }}</p>
                                @enderror
                                @else
                                    @foreach ($field as $fieldGroup)
                                <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="entry-{{ $id }}-{{ $key }}-{{ $fieldGroup }}">{{ __("layout.disease_{$key}") }}: </label>
                                <div class="row col">
                                    @if (isset($entry->$relation))
                                        @foreach ($entry->$relation as $groupKey => $groupValue)
                                    <div class="d-flex flex-nowrap row mb-2 w-100">
                                        <select{{-- id="entry-{{ $id }}-{{ $key }}-{{ $fieldGroup }}"--}} name="entry[{{ $id }}][{{ $key }}][id]" class="form-control d-inline-block" />
                                            @foreach ($$key as $inGroupKey => $inGroupValue)
                                            <option value="{{ $inGroupKey }}"@if ($groupValue->id === $inGroupKey) selected="selected"@endif>{{ $inGroupValue }}</option>
                                            @endforeach
                                        </select>
                                        <form action="" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger ml-2 mb-1">
                                                <i class="fas fa-fw fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                        @endforeach
                                    @endif
                                    <select id="entry-{{ $id }}-{{ $key }}-{{ $fieldGroup }}" name="entry[{{ $id }}][{{ $key }}][id]" class="form-control row" />
                                        <option value=""></option>
                                    @foreach ($$key as $groupKey => $groupValue)
                                        <option value="{{ $groupKey }}">{{ $groupValue }}</option>
                                    @endforeach
                                    </select>
                                    @error($fieldGroup)
                                    <p class="row text-danger">{{ $errors->first($fieldGroup) }}</p>
                                @enderror
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                        <div class="row">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary ml-auto mt-4">{{ __('layout.cancel') }}</a>
                            <input type="submit" value="{{ __('layout.update') }}" class="btn btn-primary ml-2 mt-4" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
