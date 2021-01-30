@extends('adminlte::page')
@section('title', 'Producten')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <h1><a class="h6" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i></a> Couponcodes</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card table-products">
                <div class="card-header">
                    <h3 class="card-title">Alle Couponcodes</h3><a class="btn btn-sm btn-success float-right" href="{{url('admin/couponcodes/toevoegen')}}"><i class="fas fa-plus"></i> Nieuwe code</a>
                </div>
                <div class="card-body p-2">
                    <table id="couponcodesTable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Code</th>
                                <th>Korting</th>
                                <th>Type</th>
                                <th>Minimaal bedrag</th>
                                <th style="width: 70px">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($couponcodes as $couponcode)
                            <tr>
                                <td>{{$couponcode->id}}</td>
                                <td>{{$couponcode->code}}</td>
                                <td>{{$couponcode->sort == 'amount' ? '€ '.number_format($couponcode->amount, 2, ',', ' ') : $couponcode->amount.'%'}}</td>
                                <td>{{$couponcode->type}}</td>
                                <td>€ {{number_format($couponcode->min_amount_spent, 2, ',', ' ')}}</td>
                                <td>
                                    <a href="{{url('admin/couponcodes/bewerken/'.$couponcode->id)}}" class="btn btn-sm btn-warning action-btn text-light"><i class="fas fa-pencil-alt"></i></a>
                                    <a data-href="{{url('admin/couponcodes/verwijderen/'.$couponcode->id)}}" class="btn btn-sm btn-danger action-btn text-light deleteConfirmModal"><i class="fas fa-times"></i></a>
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
            $('#couponcodesTable').DataTable({
                lengthChange: false,
                "language": {
                    "zeroRecords": "Geen Codes gevonden",
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
