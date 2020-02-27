@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('layout.edit_entry') }}</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @foreach ($entries as $id => $entry)
                        @if (!$loop->first)
                        <hr>
                        @endif
                        @foreach ($fields as $key => $field)
                            <div class="row my-2">
                                @if (gettype($field) != "array")
                                <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="entry-{{ $id }}-{{ $field }}">{{ __("layout.disease_$field") }}: </label>
                                <div class="row col">
                                    <input id="entry-{{ $id }}-{{ $field }}" name="entry[{{ $id }}][{{ $field }}]" form="diseaseUpdate" value="{{ old("entry[{$id}][{$field}]") != "" ? old("entry[{$id}][{$field}]") : $entry->$field }}" class="form-control row" />@error($field)
                                    <p class="row text-danger">{{ $errors->first($field) }}</p>
                                @enderror
                                @else
                                    @foreach ($field as $fieldGroup)
                                <label class="mb-0 col-md-5 col-lg-4 font-weight-bold" for="entry-{{ $id }}-{{ $key }}-{{ $fieldGroup }}">{{ __("layout.disease_{$key}") }}: </label>
                                <div class="row col">
                                    @if (isset($entry->$relation))
                                        @foreach ($entry->$relation as $groupKey => $groupValue)
                                    <div class="d-flex flex-nowrap row mb-2 w-100">
                                        <select{{-- id="entry-{{ $id }}-{{ $key }}-{{ $fieldGroup }}"--}} name="entry[{{ $id }}][{{ $key }}][]" class="form-control d-inline-block" form="diseaseUpdate">
                                            <option value=""></option>
                                            @foreach ($$key as $inGroupKey => $inGroupValue)
                                            <option value="{{ $inGroupKey }}"@if ($groupValue->id === $inGroupKey) selected="selected"@endif>{{ $inGroupValue }}</option>
                                            @endforeach
                                        </select>
                                        {{--@if ($loop->last)
                                        <button class="btn btn-success ml-2 mb-1">
                                            <i class="fas fa-fw fa-plus"></i>
                                        </button>
                                        @else--}}
                                        <form action="" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger ml-2 mb-1">
                                                <i class="fas fa-fw fa-times"></i>
                                            </button>
                                        </form>
                                        {{--@endif--}}
                                    </div>
                                        @endforeach
                                    @endif
                                {{--@if (count($entry->$relation) < 1)--}}
                                <div class="d-flex flex-nowrap row mb-2 w-100">
                                    <select id="entry-{{ $id }}-{{ $key }}-{{ $fieldGroup }}" name="entry[{{ $id }}][{{ $key }}][]" class="form-control d-inline-block" form="diseaseUpdate">
                                        <option value=""></option>
                                    @foreach ($$key as $groupKey => $groupValue)
                                        <option value="{{ $groupKey }}">{{ $groupValue }}</option>
                                    @endforeach
                                    </select>
                                    <button class="btn btn-success ml-2 mb-1">
                                        <i class="fas fa-fw fa-plus"></i>
                                    </button>
                                    @error($fieldGroup)
                                    <p class="row text-danger">{{ $errors->first($fieldGroup) }}</p>
                                @enderror
                                </div>
                                {{--@endif--}}
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                        <div class="row">
                            <a href="{{ route('disease.index', 'post') }}" class="btn btn-secondary ml-auto mt-4">{{ __('layout.back') }}</a>
                            <form id="diseaseUpdate" method="POST" action="{{ route('disease.update', 'post') }}">
                            @csrf
                            @method('PUT')
                                <input type="submit" value="{{ __('layout.update') }}" class="btn btn-primary ml-2 mt-4" />
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
    (function()
        {
            @component('partials.js.addsubentry')
                @slot('container')
                    .card-body
                @endslot
                @slot('button_add')
                    button.btn-success
                @endslot
                @slot('button_delete')
                    button.btn-danger
                @endslot
                @slot('elements')
                    {!! json_encode($groups) !!}
                @endslot
            @endcomponent
        }
    )();
    </script>
@endsection