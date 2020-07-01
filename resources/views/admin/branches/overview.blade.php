@extends('layouts.admin.layout')

@section('content')
<div class="containter">
    <div class="row">
        <div class="col-sm-8 offset-sm-1 pt-md-5">
            <h1>Filialen</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-10 offset-sm-1 pt-md-3">

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
                                    <th scope="col" class="text-right">
                                        <a href="" class="btn btn-success">Toevoegen</a>
                                    </th>
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
                                            <a href="{{ url('/admin/filialen/openingstijden') }}" class="btn btn-info">Openingstijden</a>
                                            <a href="{{ url('/admin/filialen/bewerken/' . $branche['id']) }}" class="btn btn-warning">Bewerken</a>
                                            {{-- TODO: Show confirmation pop up  --}}
                                            <a href="{{ url('/admin/filialen/verwijderen') }}" class="btn btn-danger">Verwijderen</a>
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