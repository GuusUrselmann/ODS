@extends('layouts.admin.layout')

@section('content')
<div class="containter">
    <div class="row">
        <div class="col-sm-6 offset-sm-3 pt-md-5">
            <h1>Filiaal Bewerken</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3 pt-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url()->current() }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="name">Naam:</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $branche['name'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig naam in.
                                </div>
                            </div>
                            <div class="col-3 form-group">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="active" {{ $branche['status'] == "active" ? "selected=selected" : "" }}>Actief</option>
                                    <option value="inactive" {{ $branche['status'] == "inactive" ? "selected=selected" : "" }}>Inactief</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="address">Adres:</label>
                                <input type="text" name="address" class="form-control" id="address" value="{{ $branche['address'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig adres in.
                                </div>
                            </div>
                            
                            <div class="col-3 form-group">
                                <label for="house_number">Huisnummer:</label>
                                <input type="text" name="house_number" class="form-control" id="house_number" value="{{ $branche['house_number'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig huisnummer in.
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="zipcode">Postcode:</label>
                                <input type="text" name="zipcode" class="form-control" id="zipcode" value="{{ $branche['zipcode'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig postcode in.
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="city">Plaats:</label>
                                <input type="text" name="city" class="form-control" id="city" value="{{ $branche['city'] }}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig plaats in.
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="phonenumber">Telefoonnummer:</label>
                                <input type="text" name="phonenumber" class="form-control" id="phonenumber" value="{{ $branche['phonenumber'] }}">
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig telefoonnummer in.
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ $branche['email'] }}">
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
                                    <option value="true" {{ $branche['cash'] ? "selected=selected" : "" }}>Ja</option>
                                    <option value="false" {{ !$branche['cash'] ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>
                            
                            <div class="col-3 form-group">
                                <label for="card">Pinnen:</label>
                                <select name="card" class="form-control" id="card">
                                    <option value="true" {{ $branche['card'] ? "selected=selected" : "" }}>Ja</option>
                                    <option value="false" {{ !$branche['card'] ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>

                            <div class="col-3 form-group">
                                <label for="ideal">Ideal:</label>
                                <select name="ideal" class="form-control" id="ideal">
                                    <option value="true" {{ $branche['ideal'] ? "selected=selected" : "" }}>Ja</option>
                                    <option value="false" {{ !$branche['ideal'] ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>

                            <div class="col-3 form-group">
                                <label for="invoice">Factuur:</label>
                                <select name="invoice" class="form-control" id="invoice">
                                    <option value="true" {{ $branche['invoice'] ? "selected=selected" : "" }}>Ja</option>
                                    <option value="false" {{ !$branche['invoice'] ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="delivery">Bezorgen:</label>
                                <select name="delivery" class="form-control" id="delivery">
                                    <option value="true" {{ $branche['delivery'] ? "selected=selected" : "" }}>Ja</option>
                                    <option value="false" {{ !$branche['delivery'] ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>
                            
                            <div class="col form-group">
                                <label for="takeaway">Afhalen:</label>
                                <select name="takeaway" class="form-control" id="takeaway">
                                    <option value="true" {{ $branche['takeaway'] ? "selected=selected" : "" }}>Ja</option>
                                    <option value="false" {{ !$branche['takeaway'] ? "selected=selected" : "" }}>Nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="max_distance_delivery">Max. afstand bezorgen:</label>
                                <div class="input-group mb-2">
                                    <input type="number" name="max_distance_delivery_km" class="form-control" id="max_distance_delivery" value="{{ $branche['delivery_max_distance_km'] }}" required>
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
                                    <input type="number" step="0.5" min="0" name="delivery_costs" class="form-control" id="delivery_costs" value="{{ $branche['delivery_costs'] }}" required>
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
                                    <input type="number" step="0.5" min="0" name="delivery_free_at" class="form-control" id="delivery_free_at" value="{{ $branche['delivery_free_at'] }}">
                                </div>
                            </div>

                            <div class="col form-group">
                                <label for="delivery_min_amount">Min. bestelbedrag:</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">€</div>
                                    </div>
                                    <input type="number" step="0.5" min="0" name="delivery_min_amount" class="form-control" id="delivery_min_amount" value="{{ $branche['delivery_min_amount'] }}">
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

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

@endsection