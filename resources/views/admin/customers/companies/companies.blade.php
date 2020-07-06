@extends('adminlte::page')

@section('title', 'Bedrijven Overzicht')

@section('content_header')
    <h1>Bedrijven</h1>
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
                            <th scope="col">KVK nummer</th>
                            <th scope="col">BTW nummer</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefoon</th>
                            <th scope="col">Actief</th>
                            <th scope="col" class="text-right">
                                <a href="{{ url('/admin/klanten/bedrijven/toevoegen') }}" class="btn btn-success">Toevoegen</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <th scope="row">{{ $company['id'] }}</th>
                                <td>{{ $company['name'] }}</td>
                                <td>{{ $company['city'] }}</td>
                                <td>{{ $company['legal_number'] }}</td>
                                <td>{{ $company['tax_number'] }}</td>
                                <td>{{ $company['email'] }}</td>
                                <td>{{ $company['phonenumber'] }}</td>
                                <td>{{ $company['status'] == "active" ? "Ja" : "Nee" }}</td>
                                <td class="text-right">
                                    <a href="{{ url('/admin/klanten/bedrijven/bewerken/' . $company['id']) }}" class="btn btn-warning">Bewerken</a>
                                    {{-- TODO: Show confirmation pop up  --}}
                                    <a href="{{ url('/admin/klanten/bedrijven/verwijderen/' . $company['id']) }}" class="btn btn-danger">Verwijderen</a>
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
