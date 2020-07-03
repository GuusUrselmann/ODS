@extends('adminlte::page')

@section('title', 'Categorie Aanmaken')

@section('content_header')
    <h1>Categorie Aanmaken</h1>
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
                            <label for="name">Naam:</label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control random-string" id="name" required>
                            </div>
                        </div>
                                                
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" class="form-control" id="status">
                                <option value="active">Actief</option>
                                <option value="inactive">Inactief</option>
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
@stop

@section('js')
<script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
