@extends('adminlte::page')

@section('title', 'Particulieren Overzicht')

@section('content_header')
    <h1>Particulieren</h1>
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
                            <th scope="col">Naam</th>
                            <th scope="col">Plaats</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefoon</th>
                            <th scope="col">Actief</th>
                            <th scope="col" class="text-right">
                                <a href="{{ url('/admin/klanten/particulieren/toevoegen') }}" class="btn btn-success">Toevoegen</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($individuals as $individual)
                            <tr>
                                <th scope="row">{{ $individual['id'] }}</th>
                                <td>{{ $individual['name'] }}</td>
                                <td>{{ $individual['city'] }}</td>
                                <td>{{ $individual['email'] }}</td>
                                <td>{{ $individual['phonenumber'] }}</td>
                                <td>{{ $individual['status'] == "active" ? "Ja" : "Nee" }}</td>
                                <td class="text-right">
                                    <a href="{{ url('/admin/klanten/particulieren/bewerken/' . $individual['id']) }}" class="btn btn-warning">Bewerken</a>
                                    {{-- TODO: Show confirmation pop up  --}}
                                    <a href="{{ url('/admin/klanten/particulieren/verwijderen/' . $individual['id']) }}" class="btn btn-danger">Verwijderen</a>
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
@stop

@section('js')
@stop
