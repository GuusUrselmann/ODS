@extends('adminlte::page')
@section('title', 'Instellingen')
@section('plugins.Sweetalert2', true)
@section('content_header')
    <h1><a class="h6" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i></a> Website Instellingen</h1>
@stop
@section('content')
    <form id="formSettings" class="form-settings needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row">
            <div class="col-sm-9">
                <div class="card p-3">
                    <div class="card-body p-0">
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Website titel</label>
                                <input type="text" class="form-control" name="website_title" value="{{$website_title}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Header titel</label>
                                <input type="text" class="form-control" name="header_title" value="{{$header_title}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Website logo</label>
                                <div class="form-image">
                                    <button type="button" class="btn btn-success image-btn">Plaatje uploaden</button>
                                    <input class="image-input" type="file" name="website_logo" form="formSettings">
                                </div>
                                <div class="form-image-preview">
                                    <label>Voorbeeld:</label><br/>
                                    <img src="{{asset($website_logo)}}" class="image-preview">
                                 </div>
                             </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Website logo</label>
                                <div class="form-image">
                                    <button type="button" class="btn btn-success image-btn">Plaatje uploaden</button>
                                    <input class="image-input" type="file" name="home_background" form="formSettings">
                                </div>
                                <div class="form-image-preview">
                                    <label>Voorbeeld:</label><br/>
                                    <img src="{{asset($home_background)}}" class="image-preview">
                                 </div>
                             </div>
                        </div>
                        <div class="col-2 float-right">
                            <button type="submit" class="form-user-add-submit btn btn-lg btn-success mb-2">Opslaan</button>
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
    <script>
        $('.image-btn').on('click', function(e) {
            $($(e.target).siblings('.image-input')).click();
        });
        $('.image-input').on('change', function(e) {
            var formGroup = e.target.closest('.form-group');
            console.log();
            if(e.target.files && e.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    console.log($(formGroup).find('.form-image-preview img')[0]);
                    $($(formGroup).find('.form-image-preview img')[0]).attr('src', e.target.result);
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@stop
