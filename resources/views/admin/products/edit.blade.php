@extends('adminlte::page')
@section('title', 'Users')
@section('plugins.Select2', true)
@section('content_header')
    <h1>Product Bewerken</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formProductEdit" class="form-product-edit" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Naam</label>
                                <input type="text" class="form-control" placeholder="Naam" name="name" value="{{$product->name}}">
                            </div>
                            <div class="form-group col-3">
                                <label>Prijs</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-euro-sign"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="00,00" name="price" value="{{$product->price}}">
                                </div>
                           </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Beschrijving</label>
                                <textarea class="form-control" rows="3" placeholder="Beschrijving" name="description">{{$product->description}}</textarea>
                             </div>
                        </div>
                        <div class="col-2 float-right">
                            <button type="submit" form="formProductEdit" class="form-user-add-submit btn btn-lg btn-success mb-2">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card p-3">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Plaatje</label>
                            <div class="form-image">
                                <button id="image-upload" class="btn btn-success">Plaatje uploaden</button>
                                <input id="image-input" type="file" name="image_path" form="formProductEdit">
                            </div>
                            <div class="form-image-preview">
                                <label>Voorbeeld:</label>
                                <img src="{{asset($product->image_path)}}" class="image-preview">
                             </div>
                         </div>
                    </div>
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
    <script>
    $(document).ready(function() {
        $('#image-upload').on('click', function() {
            $('#image-input').click();
        });
        $('#image-input').on('change', function(e) {
            if(e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".form-image-preview img").attr('src', e.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
    </script>
@stop
