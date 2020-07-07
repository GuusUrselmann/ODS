@extends('adminlte::page')

@section('title', 'Categorie Bewerken')

@section('content_header')
    <h1>Categorie Bewerken</h1>
@stop

@section('content')
<div class="containter">    
    <div class="row">
        <div class="col-sm-8 offset-sm-2 pt-md-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url()->current() }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input type="hidden" name="id" value="{{ $category['id'] }}">
                
                        <div class="form-group">
                            <label for="name">Naam:</label>
                            <div class="input-group">
                                <input type="text" name="name" class="form-control random-string" id="name" value="{{ $category['name'] }}" required>
                            </div>
                        </div>
                        
                        {{-- TODO: hide if user is only assigned to one branch --}}
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
                                                
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" class="form-control" id="status">
                                <option value="active" {{ $category['status'] == "active" ? "selected=selected" : "" }}>Actief</option>
                                <option value="inactive" {{ $category['status'] == "inactive" ? "selected=selected" : "" }}>Inactief</option>
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
