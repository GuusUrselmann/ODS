@extends('adminlte::page')

@section('title', 'Filialen Overzicht')

@section('content_header')
    <h1>Filialen</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Filiaal</th>
                            <th scope="col">Plaats</th>
                            <th scope="col">Postcode</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actief</th>
                            <th scope="col" class="text-right">
                                <a href="{{ url('/admin/filialen/toevoegen') }}" class="btn btn-success">Toevoegen</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($branches as $branche)
                            <tr>
                                <th scope="row">{{ $branche['id'] }}</th>
                                <td>{{ $branche['name'] }}</td>
                                <td>{{ $branche['zipcode'] }}</td>
                                <td>{{ $branche['city'] }}</td>
                                <td>{{ $branche['email'] }}</td>
                                <td>{{ $branche['status'] == "active" ? "Ja" : "Nee" }}</td>
                                <td class="text-right">
                                    <a href="{{ url('/admin/filialen/openingstijden') }}" class="btn btn-info">Openingstijden</a>
                                    <a href="{{ url('/admin/filialen/bewerken/' . $branche['id']) }}" class="btn btn-warning">Bewerken</a>
                                    {{-- TODO: Show confirmation pop up  --}}
                                    <a href="{{ url('/admin/filialen/verwijderen') }}" class="btn btn-danger">Verwijderen</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>    

        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
