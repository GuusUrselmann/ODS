@extends('adminlte::page')
@section('title', 'Users')
@section('plugins.Select2', true)
@section('content_header')
    <h1>Nieuwe Gebruiker</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formUserAdd" class="form-user-add needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Voornaam</label>
                                <input type="text" class="form-control" placeholder="Voornaam" name="first_name" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige voornaam in.
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label>Achternaam</label>
                                <input type="text" class="form-control" placeholder="Achternaam" name="last_name" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige achternaam in.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Gebruikersnaam</label>
                                <input type="text" class="form-control" placeholder="Gebruikersnaam" name="username" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig gebruikersnaam in.
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig email in.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Gebruiker Type</label>
                                <select class="usertype-select" name="user_type_id" id="usertypeSelect" required>
                                    @foreach($user_types as $user_type)
                                    <option value="{{ $user_type->id }}" {{ $user_type->slug == 'klant' ? 'selected' : '' }}>{{ $user_type->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig gebruiker type in.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label>Wachtwoord</label>
                                <input type="password" class="form-control" placeholder="Wachtwoord" name="password" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldig wachtwoord in.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-8">
                                <label>Permissies</label>
                                <select class="permissions-select" multiple="multiple" name="permissions[]" required>
                                    @foreach($permissions as $permission)
                                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Vul a.u.b. geldige permissies in.
                                </div>
                            </div>
                        </div>
                        <div class="col-2 float-right">
                            <button type="submit" form="formUserAdd" class="form-user-add-submit btn btn-lg btn-success mb-2">Aanmaken</button>
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
    $('#usertypeSelect').on('click', function (e) {
        var changes = {!! json_encode($group_perms_array) !!};
        var value = $(".usertype-select").val();
        $('.permissions-select').val(null).change();
        $('.permissions-select').val(changes[value]).change();
    });
    </script>
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
