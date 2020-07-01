@extends('layouts.admin.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 offset-sm-1 pt-md-5">
            <h1>Couponcodes</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Couponcode</th>
                            <th scope="col">Korting</th>
                            <th scope="col">Min. Bedrag</th>
                            <th scope="col">Eenmalig</th>
                            <th scope="col">Actief</th>
                            <th scope="col">Geldig tot</th>
                            <th scope="col" class="text-right">
                                <a href="{{ url('/admin/couponcodes/toevoegen') }}" class="btn btn-success">Toevoegen</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($couponcodes as $couponcode)
                            <tr>
                                <th scope="row">{{ $couponcode['code'] }}</th>
                                <td>
                                    @if($couponcode['sort'] == "percentage")
                                        {{ $couponcode['amount'] }} %
                                    @elseif($couponcode['sort'] == "amount")
                                        € {{ $couponcode['amount'] }}
                                    @endif
                                </td>
                                <td>€ {{ $couponcode['min_amount_spent'] }}</td>
                                <td>{{ $couponcode['one_off'] ? "Ja" : "Nee" }}</td>
                                <td>{{ $couponcode['status'] == "active" ? "Ja" : "Nee" }}</td>
                                <td>{{ $couponcode['active_till'] }}</td>
                                <td class="text-right">
                                    <a href="{{ url('/admin/couponcodes/bewerken/' . $couponcode['code']) }}" class="btn btn-warning">Bewerken</a>
                                    <a href="{{ url('/admin/couponcodes/verwijderen') }}" class="btn btn-danger">Verwijderen</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>   

        </div>
    </div>
</div>
@endsection