@extends('adminlte::page')
@section('title', 'Particulier aanmaken')
@section('plugins.Select2', true)
@section('content_header')
    <h1>Nieuwe Particulier</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-9">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url()->current() }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="customer_id" class="form-row">

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" name="username" class="form-control" id="username" required>
                            <div class="invalid-feedback">
                                Vul a.u.b. een geldige naam in.
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="first_name">Voornaam:</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige naam in.
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="last_name">Achternaam:</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige naam in.
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

                            <div class="col-3 form-group">
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

                        <div class="form-group">
                            <label for="preferred-payment">Voorkeur betaal methode:</label>
                            <select class="preferred-payment-select" name="preferred-payment[]">
                                <option value="cash">Contant</option>
                                <option value="card">Pinnen</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Aanmaken</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
@stop

@section('js')
<script>
    $(".preferred-payment-select").select2({
        width: '80%'
    });
</script>
<script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
