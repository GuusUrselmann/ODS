@extends('layouts.admin.layout')

@section('content')

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Filiaal</th>
                <th scope="col">Plaats</th>
                <th scope="col">Postcode</th>
                <th scope="col">Email</th>
                <th scope="col">Actief</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($branches as $branche)
                <tr>
                    <th scope="row">{{ $branche['id'] }}</th>
                    <td>{{ $branche['name'] }}</td>
                    <td>{{ $branche['zipcode'] }}</td>
                    <td>{{ $branche['city'] }}</td>
                    <td>{{ $branche['email'] }}</td>
                    <td>{{ $branche['status'] == "active" ? "Ja" : "Nee" }}</td>
                    <td class="text-right">
                        {{-- TODO: Connect buttons up to actions --}}
                        <button type="button" class="btn btn-info">Openingstijden</button>
                        <button type="button" class="btn btn-warning">Bewerken</button>
                        <button type="button" class="btn btn-danger">Verwijderen</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>    


@endsection