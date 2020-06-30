@extends('layouts.admin.layout')

@section('content')
<div class="containter">
    <div class="row">
        <div class="col-sm-6 offset-sm-3 pt-md-5">
            <h1>Couponcode Aanpassen</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3 pt-md-5">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="code">Coupon Code:</label>
                            <input type="text" class="form-control" id="code" value="{{ $couponcode['code'] }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="branch">Filliaal:</label>
                            <select class="form-control" name="branch">
                                @foreach($branches as $branch)
                                    <option value="{{ $branch['id'] }}" {{ $couponcode['branch_id'] == $branch['id'] ? "selected=selected" : "" }}>
                                        {{ $branch['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="col-1 form-group">
                                <label for="">Soort:</label>
                                <select class="form-control" name="sort">
                                    <option value="percentage" {{ $couponcode['sort'] == "percentage" ? "selected=selected" : "" }}>%</option>
                                    <option value="amount" {{ $couponcode['sort'] == "amount" ? "selected=selected" : "" }}>€</option>
                                </select>
                            </div>
                            <div class="col form-group">
                                <label for="">Bedrag/Percentage:</label>
                                <input type="number" step="0.5" name="amount" class="form-control" value="{{ $couponcode['amount'] }}">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="minAmount">Min. Bedrag</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">€</div>
                                </div>
                            <input type="number" step="0.5" class="form-control" id="minAmount" value="{{ $couponcode['min_amount_spent'] }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="type">Bezorgen/Afhalen:</label>
                                <select name="type" class="form-control" id="type">
                                    <option value="delivery" {{ $couponcode['type'] == "delivery" ? "selected=selected" : "" }}>Bezorgen</option>
                                    <option value="takeaway" {{ $couponcode['type'] == "takeaway" ? "selected=selected" : "" }}>Afhalen</option>
                                    <option value="both" {{ $couponcode['type'] == "both" ? "selected=selected" : "" }}>Bezorgen/Afhalen</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col form-group ">
                                <label for="status">Status:</label>
                                <select name="status" class="form-control" id="status">
                                    <option value="active">Actief</option>
                                    <option value="inactive">Inactief</option>
                                </select>
                            </div>

                            <div class="col form-group">
                                <label for="active_till">Geldig Tot:</label>
                                <input type="date" name="active_till" class="form-control" id="active_till">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="one_off">Eenmalig:</label>
                            <select name="one_off" class="form-control" id="one_off">
                                <option value="true" {{ $couponcode['one_off'] ? "selected=selected" : "" }}>Ja</option>
                                <option value="false" {{ $couponcode['one_off'] ? "selected=selected" : "" }}>Nee</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Opslaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection