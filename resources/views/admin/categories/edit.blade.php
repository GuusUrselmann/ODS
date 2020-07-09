@extends('adminlte::page')
@section('title', 'Categorie bewerken')
@section('content_header')
    <h1>Categorie Bewerken</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formCategoryEdit" class="form-category-edit needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Naam</label>
                                <input type="text" class="form-control" placeholder="Naam" name="name" value="{{$category->name}}" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige naam in.
                                </div>
                            </div>
                        </div>
                        <div class="col-2 float-right">
                            <button type="submit" form="formCategoryEdit" class="form-user-add-submit btn btn-lg btn-success mb-2">Bewerken</button>
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
