@extends('adminlte::page')

@section('title', 'Couponcode Aanmaken')

@section('content_header')
    <h1>Couponcode Aanmaken</h1>
@stop

@section('content')
<div class="containter">    
    <div class="row">
        <div class="col-sm-8 offset-sm-2 pt-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url()->current() }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-group">
                            <label for="code">Coupon Code:</label>
                            <div class="input-group">
                                <input type="text" name="code" class="form-control" id="code" required>
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-info">Willekeurig</button>
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="branch">Filliaal:</label>
                            <select class="form-control" name="branch_id">
                                @foreach($branches as $branch)
                                    <option value="{{ $branch['id'] }}">
                                        {{ $branch['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="col-1 form-group">
                                <label for="">Soort:</label>
                                <select class="form-control" name="sort">
                                    <option value="percentage">%</option>
                                    <option value="amount">€</option>
                                </select>
                            </div>
                            <div class="col form-group">
                                <label for="">Bedrag/Percentage:</label>
                                <input type="number" step="0.5" name="amount" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="minAmount">Min. Bedrag</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">€</div>
                                </div>
                                <input type="number" step="0.5" min="0" name="min_amount_spent" class="form-control" id="minAmount" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col form-group">
                                <label for="type">Bezorgen/Afhalen:</label>
                                <select name="type" class="form-control" id="type">
                                    <option value="delivery">Bezorgen</option>
                                    <option value="takeaway">Afhalen</option>
                                    <option value="both">Bezorgen/Afhalen</option>
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
                                <input type="date" name="active_till" class="form-control" id="active_till" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="one_off">Eenmalig:</label>
                            <select name="one_off" class="form-control" id="one_off">
                                <option value="true">Ja</option>
                                <option value="false">Nee</option>
                            </select>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
