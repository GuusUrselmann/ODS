@extends('adminlte::page')
@section('title', 'Gebruiker permissies')
@section('content_header')
    <h1><a class="h6" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i></a> Gebruikers Rechten</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Alle Gebruikers</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Voornaam</th>
                                <th>Achternaam</th>
                                <th>Type</th>
                                <th>Rechten Groep</th>
                                <th>Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->user_type()->name }}</td>
                                <td>{{ $user->user_type()->group()->name }}</td>
                                <td>
                                    <a href="{{url('admin/gebruikers/bewerken/'.$user->id)}}" class="btn btn-sm btn-warning action-btn text-light"><i class="fas fa-pencil-alt"></i></a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>Geen Gebruikers Gevonden</td>
                                    <td></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-3">

        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
@stop
@section('js')
@stop
