@extends('adminlte::page')
@section('title', 'Instellingen')
@section('plugins.Sweetalert2', true)
@section('content_header')
    <h1>Website Instellingen</h1>
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
                                <input type="text" class="form-control" name="website_title" value="{{$website_title->value}}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Header titel</label>
                                <input type="text" class="form-control" name="header_title" value="{{$header_title->value}}" required>
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
@stop
