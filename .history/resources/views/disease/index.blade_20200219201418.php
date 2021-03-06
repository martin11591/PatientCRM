@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('layout.diseases') }}</h1>
@endsection

@section('plugins.Datatables', true)

@section('content')
    <table id="diseases_table" class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('layout.disease') }}</th>
                <th scope="col">{{ __('layout.groups') }}</th>
                <th scope="col" data-orderable="false" data-searchable="false">{{ __('layout.actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($diseases as $disease)
            <tr>
                <td>{{ $disease->name }}</td>
                <td>@foreach ($disease->groups->all() as $group){!! (!$loop->first ? ', <br class="d-md-none" />' : '') !!}{{ $group->name }}@endforeach</td>
                <td>
                    <a href="#" class="btn btn-primary m-1" title="{{ __('layout.edit') }}"><i class="fas fa-fw fa-pen"></i></a>
                    <form method="POST" class="d-inline">
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
    <section class="paginator d-table mx-auto mt-3">
        {{ $diseases->links() }}
    </section>
@endsection

@section('js')
    <script type="text/javascript">
        @component('partials.js_datatable')
            @slot('id')
                #diseases_table
            @endslot
        @endcomponent
    </script>
@endsection