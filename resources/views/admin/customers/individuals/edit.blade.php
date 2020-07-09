@extends('adminlte::page')

@section('title', 'Particulier Bewerken')
@section('plugins.Select2', true)

@section('content_header')
    <h1>Particulier Bewerken</h1>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-9">
        <div class="card">
            <div class="card-body">
                <form action="{{ url()->current() }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <input type="hidden" name="customer_id" value="{{ $individual->id }}">

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{ $individual->user->username }}" required>
                        <div class="invalid-feedback">
                            Vul a.u.b. een geldige naam in.
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col form-group">
                            <label for="first_name">Voornaam:</label>
                            <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $individual->user->first_name }}" required>
                            <div class="invalid-feedback">
                                Vul a.u.b. een geldige naam in.
                            </div>
                        </div>

                        <div class="col form-group">
                            <label for="last_name">Achternaam:</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $individual->user->last_name }}" required>
                            <div class="invalid-feedback">
                                Vul a.u.b. een geldige naam in.
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col form-group">
                            <label for="street_name">Straatnaam:</label>
                            <input type="text" name="street_name" class="form-control" id="street_name" value="{{ $individual->contact_information->street_name }}" required>
                            <div class="invalid-feedback">
                                Vul a.u.b. een geldig adres in.
                            </div>
                        </div>
                        
                        <div class="col-3 form-group">
                            <label for="house_number">Huisnummer:</label>
                            <input type="text" name="house_number" class="form-control" id="house_number" value="{{ $individual->contact_information->house_number }}" required>
                            <div class="invalid-feedback">
                                Vul a.u.b. een geldig huisnummer in.
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col form-group">
                            <label for="zipcode">Postcode:</label>
                            <input type="text" name="zipcode" class="form-control" id="zipcode" value="{{ $individual->contact_information->zipcode }}" required>
                            <div class="invalid-feedback">
                                Vul a.u.b. een geldige postcode in.
                            </div>
                        </div>

                        <div class="col form-group">
                            <label for="city">Plaats:</label>
                            <input type="text" name="city" class="form-control" id="city" value="{{ $individual->contact_information->city }}" required>
                            <div class="invalid-feedback">
                                Vul a.u.b. een geldige plaats in.
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="col form-group">
                            <label for="phone">Telefoonnummer:</label>
                            <input type="text" name="phone" class="form-control" id="phone" value="{{ $individual->contact_information->phone }}" required>
                            <div class="invalid-feedback">
                                Vul a.u.b. een geldig telefoonnummer in.
                            </div>
                        </div>

                        <div class="col form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $individual->user->email }}" required>
                            <div class="invalid-feedback">
                                Vul a.u.b. een geldig email in.
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="preferred-payment">Voorkeur betaal methode:</label>
                        <select class="preferred-payment-select" name="preferred_payment_method">
                            <option value="cash" {{ $individual->preferred_payment_method == "cash" ? "selected" : "" }}>Contant</option>
                            <option value="card" {{ $individual->preferred_payment_method == "card" ? "selected" : "" }}>Pinnen</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Opslaan</button>
                </form>

            </div>
        </div>

    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@stop

@section('css')
<link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
@stop

@section('js')
<script src="{{ url('/js/utilities/form-validation.js') }}"></script>
<script>
    $(".preferred-payment-select").select2({
        tags: true,
        width: '80%'
    });
</script>
@stop

