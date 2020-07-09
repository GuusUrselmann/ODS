@extends('adminlte::page')

@section('title', 'Particulieren Overzicht')

@section('plugins.Datatables', true)

@section('content_header')
    <h1>Particulieren</h1>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-9">
        <div class="card">
            {{-- <div class="card-header">
                <h1 class="card-title">Particulieren Klanten</h1>
                <a href="{{ url('/admin/klanten/particulieren/toevoegen') }}" class="btn btn-sm btn-success float-right">
                    <i class="fas fa-plus mr-2"></i> Nieuwe Particulier
                </a>
            </div> --}}

            <div class="card-body">
                <table class="display table table-striped table-hover" id="individualsTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Naam</th>
                            <th scope="col">Plaats</th>
                            <th scope="col">Zipcode</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefoon</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($individuals as $individual)
                            <tr>
                                <th scope="row">{{ $individual->id }}</th>
                                <td>{{ $individual->user->first_name }} {{ $individual->user->last_name }} </td>
                                <td>{{ $individual->contact_information->city }}</td>
                                <td>{{ $individual->contact_information->zipcode }}</td>
                                <td>{{ $individual->user->email }}</td>
                                <td>{{ $individual->contact_information->phone }}</td>
                                <td class="text-right">
                                    <a href="{{ url('/admin/klanten/particulieren/bewerken/' . $individual->id) }}" class="btn btn-sm btn-warning action-btn">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a data-href="{{ url('/admin/klanten/particulieren/verwijderen/' . $individual->id) }}" class="btn btn-sm btn-danger action-btn text-light deleteConfirmModal">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Geen Particulieren Klanten Gevonden</td>
                                <td></td>
                                <td></td>
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

    <div class="col-sm-12 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list-ol"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">Aantal Particulieren Klanten</span>
            <span class="info-box-number">{{ $individuals->count() }}</span>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
@stop

@section('js')
<script src="{{ asset('js/utilities/confirm-delete.js') }}" defer></script>
<script>
    $(document).ready(function() {
        $('#individualsTable').DataTable({
            lengthChange: false,
            "columns": [
                null,
                null,
                null,
                null,
                null,
                null,
                { "orderable": false },
            ],
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
@stop
