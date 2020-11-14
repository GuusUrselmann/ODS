@extends('adminlte::page')
@section('title', 'Filiaal')
@section('content_header')
    <h1>Filiaal <b>{{$branch->name}}</b></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formCategoryAdd" class="form-category-add needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Naam</label>
                                <input type="text" class="form-control" placeholder="Naam" name="name" value="{{$branch->name}}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige naam in.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Straat</label>
                                <input type="text" class="form-control" placeholder="Straatnaam" name="contact_street_name" value="{{$branch->contactInformation->street_name}}" required>
                            </div>
                            <div class="form-group col-2">
                                <label>Huisnummer</label>
                                <input type="text" class="form-control" placeholder="Huisnummer" name="contact_house_number" value="{{$branch->contactInformation->house_number}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <label>Postcode</label>
                                <input type="text" class="form-control" placeholder="Postcode" name="contact_zipcode" value="{{$branch->contactInformation->zipcode}}" required>
                            </div>
                            <div class="form-group col-4">
                                <label>Plaats</label>
                                <input type="text" class="form-control" placeholder="Plaats" name="contact_city" value="{{$branch->contactInformation->city}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Telefoon</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="0612345678" name="contact_phone" value="{{$branch->contactInformation->phone}}" required>
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label>Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{$branch->email}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mt-4">
                            <input class="form-check-input" value="1" name="cash" type="checkbox" {{$branch->cash ? 'checked' : ''}} id="cash">
                            <label class="form-check-label" for="cash">Contant</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="1" name="card" type="checkbox" {{$branch->card ? 'checked' : ''}} id="card">
                            <label class="form-check-label" for="card">Pinnen</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="1" name="ideal" type="checkbox" {{$branch->ideal ? 'checked' : ''}} id="ideal">
                            <label class="form-check-label" for="ideal">iDeal</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="1" name="invoice" type="checkbox" {{$branch->invoice ? 'checked' : ''}} id="invoice">
                            <label class="form-check-label" for="invoice">Factuur</label>
                        </div>
                        <div class="form-check mt-4">
                            <input class="form-check-input" value="1" name="takeaway" type="checkbox" {{$branch->takeaway ? 'checked' : ''}} id="takeaway">
                            <label class="form-check-label" for="takeaway">Afhalen</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" value="1" name="delivery" type="checkbox" {{$branch->delivery ? 'checked' : ''}} id="delivery">
                            <label class="form-check-label" for="delivery">Bezorgen</label>
                        </div>
                        <div class="form-row mt-4">
                            <div class="form-group col-4">
                                <label>Bezorgen vanaf</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-euro-sign"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="0,00" name="delivery_min_amount" value="{{$branch->delivery_min_amount}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Gratis bezorgen vanaf</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-euro-sign"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="0,00" name="delivery_free_at" value="{{$branch->delivery_free_at}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-5">
                                <label>Gebieden (postcodes scheiden met een comma)</label>
                                <textarea class="form-control" placeholder="1234,5678" name="delivery_areas" rows="3">{{$branch->delivery_areas}}</textarea>
                            </div>
                        </div>
                        <div class="col-2 float-right">
                            <button type="submit" form="formCategoryAdd" class="form-user-add-submit btn btn-lg btn-success mb-2">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
@stop
@section('js')
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
