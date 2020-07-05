@extends('adminlte::page')
@section('title', 'Permissie Groepen')
@section('plugins.Select2', true)
@section('content_header')
    <h1>Permissie Groep <b>{{$group->name}}</b> Bewerken</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formGroupEdit" class="form-group-edit" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group form-inline col-12">
                                <label>Naam</label>
                                <input type="text" class="form-control" placeholder="Groep Naam" value="{{ $group->name }}" name="name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-9 col-12">
                                <label>Permissies</label>
                                <select class="permissions-select" multiple="multiple" name="permissions[]">
                                    @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}" {{ $group->hasPermission($permission->id) ? 'selected' : '' }}>{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card p-2">
                <div class="card-body p-0">
                    <button type="submit" form="formGroupEdit" class="form-group-edit-submit btn btn-success mb-2">Opslaan</button>
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
    $(".permissions-select").select2({
        tags: true,
        closeOnSelect: false,
        width: '80%'
    });
    </script>
@stop
