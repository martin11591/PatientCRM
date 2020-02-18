@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('layout.diseases') }}</h1>
@endsection

@section('plugins.Datatables', true)

@section('content')
    <table id="diseases_table" class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Choroba</th>
                <th scope="col">Grupy</th>
                <th scope="col">Akcje</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($diseases as $disease)
            <tr>
                <td>{{ $disease->name }}</td>
                <td>
                    @dd($disease->groups->get(1))
                @foreach ($disease->groups() as $group)
                    @if (!$loop->first) , @endif
                @endforeach
                </td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
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