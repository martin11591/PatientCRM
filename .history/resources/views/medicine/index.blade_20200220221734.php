@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('layout.medicines') }}</h1>
@endsection

@section('plugins.Datatables', true)

@section('content')
    <table id="medicines_table" class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th class="position-relative align-middle text-center" scope="col" data-orderable="false" data-searchable="false">
                    <form action="{{ route('medicine.delete', 'post') }}" method="POST" id="form_multi" name="multi">
                        @csrf
                        @method('DELETE')
                        <input type="checkbox" name="id" form="form_multi" id="checkbox-all" value="@foreach ($medicines as $medicine){{ (!$loop->first ? ',' : '') . $medicine->id }}@endforeach">
                        <label class="position-absolute h-100 w-100" style="left: 0; top: 0" for="checkbox-all"></label>
                    </form>
                </th>
                <th scope="col">{{ __('layout.medicine') }}</th>
                <th scope="col">{{ __('layout.groups') }}</th>
                <th scope="col">{{ __('layout.price') }}</th>
                <th scope="col" data-orderable="false" data-searchable="false">{{ __('layout.actions') }}
                    <button type="submit" form="form_multi" class="btn btn-danger m-1">
                        <i class="fas fa-fw fa-times"></i>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($medicines as $medicine)
            <tr>
                <td class="position-relative align-middle text-center">
                    <input type="checkbox" name="id[]" form="form_multi" value="{{ $medicine->id }}" id="checkbox-id-{{ $medicine->id }}">
                    <label class="position-absolute h-100 w-100" style="left: 0; top: 0" for="checkbox-id-{{ $medicine->id }}"></label>
                </td>
                <td>{{ $medicine->name }}</td>
                <td>@foreach ($medicine->groups->all() as $group){!! (!$loop->first ? ', <br class="d-md-none" />' : '') !!}{{ $group->name }}@endforeach</td>
                <td>{{ __('layout.price_value_common', ['price' => number_format($medicine->price, 2)]) }}</td>
                <td>
                    <a href="{{ route('medicine.edit', $medicine->id) }}" class="btn btn-primary m-1" title="{{ __('layout.edit') }}"><i class="fas fa-fw fa-pen"></i></a>
                    <form action="{{ route('medicine.delete', $medicine->id) }}" method="POST" class="d-inline">
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
    @if ($medicines->lastPage() > 1)
    <section class="paginator d-table mx-auto mt-3">
        {{ $perPage != 10 ? $medicines->appends(['perPage' => $perPage])->links() : $medicines->links() }}
    </section>
    @endif
@endsection

@section('js')
    <script type="text/javascript">
    (function()
        {
            @component('partials.js.datatable')
                @slot('id')
                    #medicines_table
                @endslot
            @endcomponent
        
            @component('partials.js.select_all')
                @slot('global_selector')
                    #medicines_table thead>tr:first>th:first
                @endslot
                @slot('local_selector')
                    #checkbox-all
                @endslot
            @endcomponent
        }
    )();
    </script>
@endsection