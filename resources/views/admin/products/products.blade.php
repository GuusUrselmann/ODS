@extends('adminlte::page')
@section('title', 'Products')
@section('plugins.Datatables', true)
@section('content_header')
    <h1>Producten</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card table-users">
                <div class="card-header">
                    <h3 class="card-title">Alle Producten</h3><a class="btn btn-sm btn-success float-right" href="{{url('admin/producten/toevoegen')}}"><i class="fas fa-plus"></i> Nieuw product</a>
                </div>
                <div class="card-body p-0">
                    <table id="productsTable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Voornaam</th>
                                <th>Achternaam</th>
                                <th>Type</th>
                                <th>Permissie Groep</th>
                                <th>Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>1</td>
                                <td>
                                    <a href="{{url('admin/producten/bewerken/'.$product->id)}}" class="btn btn-sm btn-warning action-btn text-light"><i class="fas fa-pencil-alt"></i></a>
                                    <a data-href="{{url('admin/gebruikers/verwijderen/'.$product->id)}}" class="btn btn-sm btn-danger action-btn text-light" data-toggle="modal" data-target="#deleteConfirmModal"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>Geen Producten Gevonden</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Aantal Producten</span>
                <span class="info-box-number">{{ $products->count() }}</span>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="deleteConfirmModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    Weet je zeker dat je deze actie wilt uitvoeren?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-ok" data-dismiss="modal" aria-label="Close">Nee</button>
                    <a class="btn btn-primary btn-ok">Ja</a>
                </div>
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
            $('#usersTable').DataTable({
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
