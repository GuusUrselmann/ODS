@extends('adminlte::page')

@section('title', 'Bedrijven Overzicht')

@section('content_header')
    <h1>Bedrijven</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-9">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Bedrijven</h1>
                     <a href="{{ url('/admin/klanten/bedrijven/toevoegen') }}" class="btn btn-sm btn-success float-right">
                        <i class="fas fa-plus"></i> Toevoegen
                    </a>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Naam</th>
                                <th scope="col">Plaats</th>
                                <th scope="col">KVK nummer</th>
                                <th scope="col">BTW nummer</th>
                                <th scope="col">Email</th>
                                <th scope="col">Telefoon</th>
                                <th scope="col">Actief</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($companies as $company)
                                <tr>
                                    <th scope="row">{{ $company->id }}</th>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->contact_information->city }}</td>
                                    <td>{{ $company->legal_number }}</td>
                                    <td>{{ $company->tax_number }}</td>
                                    <td>{{ $company->contact_information->email }}</td>
                                    <td>{{ $company->contact_information->phone }}</td>
                                    <td>{{ $company->status == "active" ? "Ja" : "Nee" }}</td>
                                    <td class="text-right">
                                        <a href="{{ url('/admin/klanten/bedrijven/bewerken/' . $company->id) }}" class="btn btn-sm btn-warning action-btn">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>                                    
                                        <a data-href="{{ url('admin/klanten/bedrijven/verwijderen/'. $company->id) }}" class="btn btn-sm btn-danger action-btn text-light deleteConfirmModal">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-ol"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Aantal Bedrijven</span>
                <span class="info-box-number">{{ $companies->count() }}</span>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
@stop

@section('js')
<script src="{{ asset('js/utilities/confirm-delete.js') }}" defer></script>
@stop
