@extends('layouts.admin.layout')

@section('content')
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
                <th scope="col"></th>
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
                        {{-- TODO: Connect buttons up to actions --}}
                        <button type="button" class="btn btn-warning">Bewerken</button>
                        <button type="button" class="btn btn-danger">Verwijderen</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>    
@endsection