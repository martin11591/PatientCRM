@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __("layout.{$title}s") }}</h1>
@endsection

@section('plugins.Datatables', (isset($dataTable) && $dataTable !== false) ? true : false)

@section('content')
    <table id="{{ $title }}_table" class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th class="position-relative align-middle text-center" scope="col" data-orderable="false" data-searchable="false" style="width: 64px; width: 4rem">
                    <form action="{{ route("{$route}.delete", 'post') }}" method="POST" id="form_multi" name="multi">
                        @csrf
                        @method('DELETE')
                        <input type="checkbox" name="id" form="form_multi" id="checkbox-all" value="@foreach ($entries as $entry){{ (!$loop->first ? ',' : '') . $entry->id }}@endforeach">
                        <label class="position-absolute h-100 w-100" style="left: 0; top: 0" for="checkbox-all"></label>
                    </form>
                </th>
                @foreach ($fields as $field)
                <th class="align-middle" scope="col">{{ __("layout.{$title}_{$field}") }}</th>
                @endforeach
                <th class="align-middle" scope="col" data-orderable="false" data-searchable="false" style="width: 176px; width: 11rem">{{ __('layout.actions') }}
                    <button type="submit" form="form_multi" class="btn btn-danger m-1">
                        <i class="fas fa-fw fa-times"></i>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="{{ count($fields) + 2 }}" class="text-center">
                    <a href="{{ route("{$route}.create") }}" class="btn btn-success m-1"><i class="fas fa-fw fa-plus"></i></a>
                </td>
            </tr>
        @foreach ($entries as $entry)
            <tr>
                <td class="position-relative align-middle text-center">
                    <input type="checkbox" name="id[]" form="form_multi" value="{{ $entry->id }}" id="checkbox-id-{{ $entry->id }}">
                    <label class="position-absolute h-100 w-100" style="left: 0; top: 0" for="checkbox-id-{{ $entry->id }}"></label>
                </td>
                @foreach ($fields as $field)
                <td class="align-middle">{{ $entry->$field }}</td>
                @endforeach
                <td>
                    <a href="{{ route("{$route}.edit", $entry->id) }}" class="btn btn-primary m-1" title="{{ __('layout.edit') }}"><i class="fas fa-fw fa-pen"></i></a>
                    <form action="{{ route("{$route}.delete", $entry->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger m-1">
                            <i class="fas fa-fw fa-times"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if ($entries->lastPage() > 1)
    <section class="paginator d-table mx-auto mt-3">
        {{ $perPage != 10 ? $entries->appends(['perPage' => $perPage])->links() : $entries->links() }}
    </section>
    @endif
    <section class="per-page d-table mx-auto mt-3 text-center">
        <em>{{ __('layout.per_page') }}: {{ request()->perPage }}</em><br>
        <a class="mx-2@if (request()->perPage == 10) @endif" href="?perPage=10">10</a>
        <a class="mx-2@if (request()->perPage == 20) @endif" href="?perPage=20">20</a>
        <a class="mx-2@if (request()->perPage == 50) @endif" href="?perPage=50">50</a>
        <a class="mx-2@if (request()->perPage == 100) @endif" href="?perPage=100">100</a>
    </section>
@endsection

@section('js')
    <script type="text/javascript">
    (function()
        {
        @if (isset($dataTable) && $dataTable !== false)
            @component('partials.js.datatable')
                @slot('id')
                    #{{ $title }}_table
                @endslot
            @endcomponent
        @endif
            
            @component('partials.js.multiselect')
                @slot('table_id')
                    #{{ $title }}_table
                @endslot
                @slot('global_selector')
                    thead>tr:first>th:first
                @endslot
                @slot('local_selector')
                    #checkbox-all
                @endslot
                @slot('route')
                    {{ $route }}
                @endslot
            @endcomponent
        }
    )();
    </script>
@endsection