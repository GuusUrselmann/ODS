@extends('adminlte::page')
@section('title', 'Users')
@section('plugins.Select2', true)
@section('content_header')
    <h1>Gebruiker Bewerken</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formUserEdit" class="form-user-edit" method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Voornaam</label>
                                <input type="text" class="form-control" placeholder="Voornaam" name="first_name" value="{{$user->first_name}}">
                            </div>
                            <div class="form-group col-4">
                                <label>Achternaam</label>
                                <input type="text" class="form-control" placeholder="Achternaam" name="last_name" value="{{$user->last_name}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Gebruikersnaam</label>
                                <input type="text" class="form-control" placeholder="Gebruikersnaam" name="username" value="{{$user->username}}">
                            </div>
                            <div class="form-group col-4">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Gebruiker Type</label>
                                <select class="usertype-select" name="user_type_id" id="usertypeSelect">
                                    @foreach($user_types as $user_type)
                                    <option value="{{ $user_type->id }}" {{ $user_type->slug == $user->user_type()->slug ? 'selected' : '' }}>{{ $user_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Wachtwoord</label>
                                <input type="password" class="form-control" placeholder="Wachtwoord" name="password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-8">
                                <label>Permissies</label>
                                <select class="permissions-select" multiple="multiple" name="permissions[]">
                                    @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}"{{ $user->hasPermission($permission->name) ? 'selected' : '' }}>{{ $permission->name }}</option>
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
                    <button type="submit" form="formUserEdit" class="form-user-edit-submit btn btn-success mb-2">Opslaan</button>
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
    $(".usertype-select").select2({
        tags: true,
        width: '80%'
    });
    $(".permissions-select").select2({
        tags: true,
        closeOnSelect: false,
        width: '80%'
    });
    $('#usertypeSelect').on('select2:select', function (e) {
        var changes = {!! json_encode($group_perms_array) !!};
        var value = $(".usertype-select").val();
        $('.permissions-select').val(null).change();
        $('.permissions-select').val(changes[value]).change();
    });
    </script>
@stop
