@extends('adminlte::page')
@section('title', 'Categorieën Overzicht')

@section('content_header')
    <h1>Categorieën</h1>
@stop

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Positie</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actief</th>
                            <th scope="col" class="text-right">
                                <a href="{{ url('/admin/categorieen/toevoegen') }}" class="btn btn-success">Toevoegen</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category['webshop_position'] }}</th>
                                <td>{{ $category['name'] }}</td>
                                <td>{{ $category['status'] == "active" ? "Ja" : "Nee" }}</td>
                                <td class="text-right">
                                    <a href="{{ url('/admin/categorieen/bewerken/' . $category['id']) }}" class="btn btn-warning">bewerken</a>
                                    <a href="{{ url('/admin/categorieen/verwijderen/' . $category['id']) }}" class="btn btn-danger">Verwijderen</a>
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
@stop
