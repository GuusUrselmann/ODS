@extends('adminlte::page')

@section('title', 'Bedrijf Toevoegen')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-9">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url()->current() }}" method="POST" class="needs-validation" id="formCompanyAdd" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="name">Naam:</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige naam in.
                                </div>
                            </div>
                            <div class="col-3 form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="active">Actief</option>
                                    <option value="inactive">Inactief</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="legal_number">KVK nummer:</label>
                                <input type="text" name="legal_number" class="form-control" id="legal_number" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig KVK nummer in.
                                </div>
                            </div>
                            
                            <div class="col-6 form-group">
                                <label for="tax_number">BTW nummer:</label>
                                <input type="text" name="tax_number" class="form-control" id="tax_number" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig BTW nummer in.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="street_name">Straatnaam:</label>
                                <input type="text" name="street_name" class="form-control" id="street_name" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig adres in.
                                </div>
                            </div>
                            
                            <div class="col-2 form-group">
                                <label for="house_number">Huisnummer:</label>
                                <input type="text" name="house_number" class="form-control" id="house_number" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig huisnummer in.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="zipcode">Postcode:</label>
                                <input type="text" name="zipcode" class="form-control" id="zipcode" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige postcode in.
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="city">Plaats:</label>
                                <input type="text" name="city" class="form-control" id="city" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige plaats in.
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="phone">Telefoonnummer:</label>
                                <input type="text" name="phone" class="form-control" id="phone" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig telefoonnummer in.
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig email in.
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>

        <div class="col-sm-12 col-md-3">
            <div class="small-box bg-white">
                <div class="inner">
                    <h4>Bedrijf Toevoegen</h4>
                    <button type="submit" form="formCompanyAdd" class="btn btn-primary btn-block mt-5">Opslaan</button>
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
