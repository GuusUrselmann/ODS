@extends('adminlte::page')
@section('title', 'Producten')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <h1><a class="h6" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i></a> Menu's</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card table-products">
                <div class="card-header">
                    <h3 class="card-title">Alle Menu's</h3><a class="btn btn-sm btn-success float-right" href="{{url('admin/menus/toevoegen')}}"><i class="fas fa-plus"></i> Nieuw menu</a>
                </div>
                <div class="card-body p-0">
                    <table id="menusTable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Naam</th>
                                <th style="width: 100px">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                            <tr>
                                <td>{{$menu->id}}</td>
                                <td>{{$menu->name}}</td>
                                <td>
                                    <a href="{{url('admin/menus/bewerken/'.$menu->id)}}" class="btn btn-sm btn-warning action-btn text-light"><i class="fas fa-pencil-alt"></i></a>
                                    <a data-href="{{url('admin/menus/verwijderen/'.$menu->id)}}" class="btn btn-sm btn-danger action-btn text-light deleteConfirmModal"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>Geen Menu Gevonden</td>
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
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-utensils"></i></span>
                <div class="info-box-content">
                <span class="info-box-text">Aantal Menus</span>
                <span class="info-box-number">{{ $menus->count() }}</span>
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
            $('#productsTable').DataTable({
                lengthChange: false,
                "language": {
                    "zeroRecords": "Geen Producten gevonden",
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
            $(".deleteConfirmModal").on('click', function () {
                Swal.fire({
                    title: "Weet u het zeker?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#dc3545",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Ja, verwijder!",
                    cancelButtonText: "Annuleren",
                }).then((result) => {
                    if (result.value) {
                        window.location.replace($(this).attr("data-href"));
                    }
                });
            });
        });

    </script>
    <script src="{{ asset('js/utilities/confirm-delete.js') }}" defer></script>
@stop
