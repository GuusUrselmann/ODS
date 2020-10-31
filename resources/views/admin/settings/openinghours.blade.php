@extends('adminlte::page')
@section('title', 'Instellingen')
@section('content_header')
    <h1>Instellingen - Openingstijden</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formSettings" class="form-settings needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-group">
                            <div class="row">
                            </div>
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
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
