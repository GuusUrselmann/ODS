@extends('adminlte::page')
@section('title', 'Producten')
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
    <h1>Bestellingen</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card table-orders">
                <div class="card-header">
                    <h3 class="card-title">Alle Bestellingen</h3>
                </div>
                <div class="card-body p-0">
                    <table id="ordersTable" class="display table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 40px">Uuid</th>
                                <th>Prijs</th>
                                <th>Bezorgtijd</th>
                                <th>Status</th>
                                <th>Mollie ID</th>
                                <th>Gebruiker</th>
                                <th style="width: 100px">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->uuid}}</td>
                                <td>€{{$order->amount}}</td>
                                <td>{{$order->order_datetime}}</td>
                                <td>{{$order->status == 'in_process' ? 'in behandeling' : ''}}</td>
                                <td>{{$order->mollie_payment_id}}</td>
                                <td>{{$order->user()->username}}</td>
                                <td>
                                    <a href="{{url('admin/bestellingen/bewerken/'.$order->id)}}" class="btn btn-sm btn-warning action-btn text-light"><i class="fas fa-pencil-alt"></i></a>
                                    <a data-href="{{url('admin/bestellingen/verwijderen/'.$order->id)}}" class="btn btn-sm btn-danger action-btn text-light deleteConfirmModal"><i class="fas fa-times"></i></a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td></td>
                                    <td>Geen Bestelling Gevonden</td>
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
                <span class="info-box-text">Aantal Bestellingen</span>
                <span class="info-box-number">{{ $orders->count() }}</span>
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
            $('#ordersTable').DataTable({
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
