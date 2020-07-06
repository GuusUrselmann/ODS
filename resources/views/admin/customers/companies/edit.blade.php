@extends('adminlte::page')

@section('title', 'Bedrijf Bewerken')

@section('content_header')
    <h1>Bedrijf Bewerken</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url()->current() }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <input type="hidden" name="company_id" value="{{ $company['id'] }}">

                            <div class="col form-group">
                                <label for="name">Naam:</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $company['name'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige naam in.
                                </div>
                            </div>
                            <div class="col-3 form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="active" {{ $company['status'] == "active" ? "selected=selected" : "" }}>Actief</option>
                                    <option value="inactive" {{ $company['status'] == "inactive" ? "selected=selected" : "" }}>Inactief</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="legal_number">KVK nummer:</label>
                                <input type="text" name="legal_number" class="form-control" id="legal_number" value="{{ $company['legal_number'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig KVK nummer in.
                                </div>
                            </div>
                            
                            <div class="col-6 form-group">
                                <label for="tax_number">BTW nummer:</label>
                                <input type="text" name="tax_number" class="form-control" id="tax_number" value="{{ $company['tax_number'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig BTW nummer in.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="address">Straatnaam:</label>
                                <input type="text" name="address" class="form-control" id="address" value="{{ $company['address'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig adres in.
                                </div>
                            </div>
                            
                            <div class="col-2 form-group">
                                <label for="house_number">Huisnummer:</label>
                                <input type="text" name="house_number" class="form-control" id="house_number" value="{{ $company['house_number'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig huisnummer in.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="zipcode">Postcode:</label>
                                <input type="text" name="zipcode" class="form-control" id="zipcode" value="{{ $company['zipcode'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige postcode in.
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="city">Plaats:</label>
                                <input type="text" name="city" class="form-control" id="city" value="{{ $company['city'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige plaats in.
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="phonenumber">Telefoonnummer:</label>
                                <input type="text" name="phonenumber" class="form-control" id="phonenumber" value="{{ $company['phonenumber'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig telefoonnummer in.
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $company['email'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig email in.
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

