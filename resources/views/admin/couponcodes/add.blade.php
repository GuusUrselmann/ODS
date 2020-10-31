@extends('adminlte::page')
@section('title', 'Couponcode aanmaken')
@section('plugins.Select2', true)
@section('content_header')
    <h1>Nieuwe Couponcode</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formCouponcodeAdd" class="form-couponcode-add needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Code</label>
                                <input type="text" class="form-control" placeholder="Couponcode" name="code" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige code in.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-3">
                                <label>Type</label>
                                <select class="type-select" name="type" id="typeSelect" required>
                                    <option value="delivery" selected>Bezorgen</option>
                                    <option value="takeaway">Afhalen</option>
                                    <option value="both">Beide</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <label>Korting</label>
                                <input type="text" class="form-control" placeholder="10" name="amount" required>
                            </div>
                            <div class="form-group col-2">
                                <label>Soort korting</label>
                                <select class="sort-select" name="sort" id="sortSelect" required>
                                    <option value="percentage" selected>Percentage</option>
                                    <option value="amount">Bedrag</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-3">
                            <label>Minimaal bedrag</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-euro-sign"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="00,00" name="min_amount_spent" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig bedrag in.
                                </div>
                            </div>
                       </div>
                        <div class="col-2 float-right">
                            <button type="submit" form="formCouponcodeAdd" class="form-couponcode-add-submit btn btn-lg btn-success mb-2">Aanmaken</button>
                        </div>
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
    $(document).ready(function() {
        $(".type-select").select2({
            tags: true,
            width: '80%'
        });
        $(".sort-select").select2({
            tags: true,
            width: '80%'
        });
    });
    </script>
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
