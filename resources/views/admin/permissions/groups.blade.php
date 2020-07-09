@extends('adminlte::page')
@section('title', 'Permissie Groepen')
@section('plugins.Datatables', true)
@section('content_header')
    <h1>Permissie Groepen</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Alle Groepen</h3><a class="btn btn-sm btn-success float-right" href="{{url('admin/permissies/groepen/toevoegen')}}"><i class="fas fa-plus"></i> Nieuwe groep</a>
                </div>
                <div class="card-body p-0">
                    <table id="groupsTable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Groep Naam</th>
                                <th>Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($groups as $group)
                            <tr>
                                <td>{{ $group->id }}</td>
                                <td>{{ $group->name }}</td>
                                <td>
                                    <a href="{{url('admin/permissies/groepen/bewerken/'.$group->id)}}" class="btn btn-sm btn-warning action-btn text-light"><i class="fas fa-pencil-alt"></i></a>
                                    <a data-href="{{url('admin/permissies/groepen/verwijderen/'.$group->id)}}" class="btn btn-sm btn-danger action-btn text-light deleteConfirmModal"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>Geen Groepen Gevonden</td>
                                    <td></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-ol"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Aantal Groepen</span>
                <span class="info-box-number">{{ $groups->count() }}</span>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#groupsTable').DataTable({
                lengthChange: false,
                "language": {
                    "zeroRecords": "Geen gebruikers gevonden",
                    "info": "Pagina _PAGE_ / _PAGES_",
                    "search": "Zoeken:",
                    "paginate": {
                        "first": "Eerste",
                        "last": "Laatste",
                        "next": "Volgende",
                        "previous": "Vorige"
                    },
                }
            });
        });
    </script>
    <script src="{{ asset('js/utilities/confirm-delete.js') }}" defer></script>
@stop
