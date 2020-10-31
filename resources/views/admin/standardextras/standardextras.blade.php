@extends('adminlte::page')
@section('title', 'Users')
@section('plugins.Datatables', true)
@section('content_header')
    <h1>Standaard Extra's</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card table-users">
                <div class="card-header">
                    <h3 class="card-title">Alle Standaard Extra's</h3><a class="btn btn-sm btn-success float-right" href="{{url('admin/standaard-extras/toevoegen')}}"><i class="fas fa-plus"></i> Nieuwe standaard extra</a>
                </div>
                <div class="card-body p-0">
                    <table id="standardExtrasTable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Naam</th>
                                <th>Type</th>
                                <th>Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($standard_extras as $standard_extra)
                            <tr>
                                <td>{{ $standard_extra->id }}</td>
                                <td>{{ $standard_extra->name }}</td>
                                <td>{{ $standard_extra->type }}</td>
                                <td>
                                    <a href="{{url('admin/standaard-extras/bewerken/'.$standard_extra->id)}}" class="btn btn-sm btn-warning action-btn text-light"><i class="fas fa-pencil-alt"></i></a>
                                    <a data-href="{{url('admin/standaard-extras/verwijderen/'.$standard_extra->id)}}" class="btn btn-sm btn-danger action-btn text-light deleteConfirmModal"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#standardExtrasTable').DataTable({
                lengthChange: false,
                "language": {
                    "zeroRecords": "Geen extra's gevonden",
                    "info": "Pagina _PAGE_ / _PAGES_",
                    "infoEmpty": 'Pagina 1 / 1 ',
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
