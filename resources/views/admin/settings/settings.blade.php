@extends('adminlte::page')
@section('title', 'Instellingen')
@section('plugins.Sweetalert2', true)
@section('content_header')
    <h1>Algemene Instellingen</h1>
@stop
@section('content')
    <form id="formSettings" class="form-settings needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
        <h4>Bedrijf</h4>
        <div class="row">
            <div class="col-sm-9">
                <div class="card p-3">
                    <div class="card-body p-0">
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Bedrijfsnaam</label>
                                <input type="text" class="form-control" name="company_name" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h4>Bestellingen</h4>
        <div class="row">
            <div class="col-sm-9">
                <div class="card p-3">
                    <div class="card-body p-0">
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Postcodes (scheiden met een comma)</label>
                                <textarea class="form-control" rows="3" placeholder="1234AB, 5678CD..." name="orders_postal_codes"></textarea>
                                <div class="invalid-feedback">
                                    Vul a.u.b. geldige postcodes in.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Extra kosten op afstand</label>
                                <div>
                                    <label>< 10km</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-euro-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="0,00" name="last_name" required>
                                    </div>
                                </div>
                                <div>
                                    <label>10-25km</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-euro-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="0,00" name="last_name" required>
                                    </div>
                                </div>
                                <div>
                                    <label>> 25km</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-euro-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="0,00" name="last_name" required>
                                    </div>
                                </div>

                                <div class="invalid-feedback">
                                    Vul a.u.b. geldige postcodes in.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
@stop
@section('js')
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
