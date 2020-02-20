@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('layout.diseases') }}</h1>
@endsection

@section('plugins.Datatables', true)

@section('content')
    <table id="diseases_table" class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th class="position-relative align-middle text-center" scope="col" data-orderable="false" data-searchable="false">
                    <form action="" method="POST" id="form_multi" name="multi">
                        <input type="checkbox" name="id" form="form_multi" id="checkbox-all" value="@foreach ($diseases as $disease){{ (!$loop->first ? ',' : '') . $disease->id }}@endforeach">
                        <label class="position-absolute h-100 w-100" style="left: 0; top: 0" for="checkbox-all"></label>
                    </form>
                </th>
                <th scope="col">{{ __('layout.disease') }}</th>
                <th scope="col">{{ __('layout.groups') }}</th>
                <th scope="col" data-orderable="false" data-searchable="false">{{ __('layout.actions') }}
                    <button type="submit" form="form_multi" class="btn btn-danger m-1">
                        <i class="fas fa-fw fa-times"></i>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach ($diseases as $disease)
            <tr>
                <td class="position-relative align-middle text-center">
                    <input type="checkbox" name="id[]" form="form_multi" value="{{ $disease->id }}" id="checkbox-id-{{ $disease->id }}">
                    <label class="position-absolute h-100 w-100" style="left: 0; top: 0" for="checkbox-id-{{ $disease->id }}"></label>
                </td>
                <td>{{ $disease->name }}</td>
                <td>@foreach ($disease->groups->all() as $group){!! (!$loop->first ? ', <br class="d-md-none" />' : '') !!}{{ $group->name }}@endforeach</td>
                <td>
                    <a href="{{ route('disease.edit', $disease->id) }}" class="btn btn-primary m-1" title="{{ __('layout.edit') }}"><i class="fas fa-fw fa-pen"></i></a>
                    <form action="{{ route('disease.delete', $disease->id) }}" method="POST" class="d-inline">
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
    @if ($diseases->lastPage() > 1)
    <section class="paginator d-table mx-auto mt-3">
        {{ $perPage != 10 ? $diseases->appends(['perPage' => $perPage])->links() : $diseases->links() }}
    </section>
    @endif
@endsection

@section('js')
    <script type="text/javascript">
    (function()
    {
        @component('partials.js.datatable')
            @slot('id')
                #diseases_table
            @endslot
        @endcomponent
        
        @component('partials.js.select_all')
            @slot('global_selector')
                #diseases_table thead>tr:first>th:first
            @endslot
            @slot('local_selector')
                #checkbox-all
            @endslot
        @endcomponent
    })();
    </script>
@endsection