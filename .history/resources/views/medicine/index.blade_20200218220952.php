@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('layout.medicines') }}</h1>
@endsection

@section('plugins.Datatables', true)

@section('content')
    <table id="medicines_table" class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">{{ __('layout.medicine') }}</th>
                <th scope="col">{{ __('layout.groups') }}</th>
                <th scope="col">{{ __('layout.price') }}</th>
                <th scope="col" data-orderable="false" data-searchable="false">{{ __('layout.actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($medicines as $medicine)
            <tr>
                <td>{{ $medicine->name }}</td>
                <td>@foreach ($medicine->groups->all() as $group){!! (!$loop->first ? ', <br class="d-md-none" />' : '') !!}{{ $group->name }}@endforeach</td>
                <td>{{ __('layout.price_value_common', ['price' => $medicine->price]) }}</td>
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
@endsection

@section('js')
    <script type="text/javascript">
        @component('partials.js_datatable')
            @slot('id')
                #medicines_table
            @endslot
        @endcomponent
    </script>
@endsection