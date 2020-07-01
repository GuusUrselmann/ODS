@extends('layouts.admin.layout')

@section('content')

{{-- TODO: needs to be on the right --}}
<a href="" class="btn btn-success">Toevoegen</a>

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
                        <a href="" class="btn btn-info">Openingstijden</a>
                        <a href="" class="btn btn-warning">Bewerken</a>
                        <a href="" class="btn btn-danger">Verwijderen</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>    


@endsection