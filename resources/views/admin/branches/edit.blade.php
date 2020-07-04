@extends('adminlte::page')

@section('title', 'Filiaal Bewerken')

@section('content_header')
    <h1>Filiaal Bewerken</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url()->current() }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="name">Naam:</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $branch->name }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig naam in.
                                </div>
                            </div>
                            <div class="col-3 form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="active" {{ $branch->status == "active" ? "selected=selected" : "" }}>Actief</option>
                                    <option value="inactive" {{ $branch->status == "inactive" ? "selected=selected" : "" }}>Inactief</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="address">Adres:</label>
                                <input type="text" name="address" class="form-control" id="address" value="{{ $branch->address }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig adres in.
                                </div>
                            </div>
                            
                            <div class="col-3 form-group">
                                <label for="house_number">Huisnummer:</label>
                                <input type="text" name="house_number" class="form-control" id="house_number" value="{{ $branch->house_number }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig huisnummer in.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="zipcode">Postcode:</label>
                                <input type="text" name="zipcode" class="form-control" id="zipcode" value="{{ $branch->zipcode }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig postcode in.
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="city">Plaats:</label>
                                <input type="text" name="city" class="form-control" id="city" value="{{ $branch->city }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig plaats in.
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="phonenumber">Telefoonnummer:</label>
                                <input type="text" name="phonenumber" class="form-control" id="phonenumber" value="{{ $branch->phonenumber }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig telefoonnummer in.
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $branch->email }}">
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig email in.
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="col-3 form-group">
                                <label for="cash">Contant:</label>
                                <select name="cash" class="form-control" id="cash">
                                    <option value="1" {{ $branch->cash ? "selected=selected" : "" }}>Ja</option>
                                    <option value="0" {{ !$branch->cash ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>
                            
                            <div class="col-3 form-group">
                                <label for="card">Pinnen:</label>
                                <select name="card" class="form-control" id="card">
                                    <option value="1" {{ $branch->card ? "selected=selected" : "" }}>Ja</option>
                                    <option value="0" {{ !$branch->card ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>

                            <div class="col-3 form-group">
                                <label for="ideal">Ideal:</label>
                                <select name="ideal" class="form-control" id="ideal">
                                    <option value="1" {{ $branch->ideal ? "selected=selected" : "" }}>Ja</option>
                                    <option value="0" {{ !$branch->ideal ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>

                            <div class="col-3 form-group">
                                <label for="invoice">Factuur:</label>
                                <select name="invoice" class="form-control" id="invoice">
                                    <option value="1" {{ $branch->invoice ? "selected=selected" : "" }}>Ja</option>
                                    <option value="0" {{ !$branch->invoice ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="delivery">Bezorgen:</label>
                                <select name="delivery" class="form-control" id="delivery">
                                    <option value="1" {{ $branch->delivery ? "selected=selected" : "" }}>Ja</option>
                                    <option value="0" {{ !$branch->delivery ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>
                            
                            <div class="col form-group">
                                <label for="takeaway">Afhalen:</label>
                                <select name="takeaway" class="form-control" id="takeaway">
                                    <option value="1" {{ $branch->takeaway ? "selected=selected" : "" }}>Ja</option>
                                    <option value="0" {{ !$branch->takeaway ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="max_distance_delivery">Max. afstand bezorgen:</label>
                                <div class="input-group mb-2">
                                    <input type="number" name="delivery_max_distance" class="form-control" id="max_distance_delivery" value="{{ $branch->delivery_max_distance }}" required>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">km</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="delivery_costs">Bezorg kosten:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">€</div>
                                    </div>
                                    <input type="number" step="0.5" min="0" name="delivery_costs" class="form-control" id="delivery_costs" value="{{ $branch->delivery_costs }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="delivery_free_at">Gratis bezorging vanaf:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">€</div>
                                    </div>
                                    <input type="number" step="0.5" min="0" name="delivery_free_at" class="form-control" id="delivery_free_at" value="{{ $branch->delivery_free_at }}">
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="delivery_min_amount">Min. bestelbedrag:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">€</div>
                                    </div>
                                    <input type="number" step="0.5" min="0" name="delivery_min_amount" class="form-control" id="delivery_min_amount" value="{{ $branch->delivery_min_amount }}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Opslaan</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop