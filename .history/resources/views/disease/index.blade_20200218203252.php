@extends('home')

@section('content_header')
    <h1 class="m-0 text-dark">{{ __('layout.diseases') }}</h1>
@endsection

@section('plugins.Datatables', true)

@section('content')
    <table id="diseases_table">
        <thead>
            <tr>
                <th>Choroba</th>
                <th>Grupy</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($diseases as $disease)
            <tr>
                <td>{{ $disease->name }}</td>
                <td></td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script type="text/javascript">
        @component('partials.js.datatable')
            @slot('id')
                #diseases_table
            @endslot
        @endcomponent
    </script>
@endsection