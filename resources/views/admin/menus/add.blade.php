@extends('adminlte::page')
@section('title', 'Product aanmaken')
@section('plugins.Select2', true)
@section('content_header')
    <h1><a class="h6" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i></a> Nieuw Menu</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formMenuAdd" class="form-menu-add needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Naam</label>
                                <input type="text" class="form-control" placeholder="Naam" name="name" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige naam in.
                                </div>
                            </div>
                        </div>
                        <div>
                            <menubuilder :categories-data="{{$categories}}" :products-data="{{$products}}" />
                        </div>
                        <div class="col-2 float-right">
                            <button type="submit" form="formMenuAdd" class="form-user-add-submit btn btn-lg btn-success mb-2">Aanmaken</button>
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
    <script>
    function url() {
        return '<?= url('') ?>';
    }
    function asset() {
        return '<?= asset('') ?>'
    }
    </script>
    <script>
    $(document).ready(function() {
        $(".categories-select").select2({
            tags: true,
            closeOnSelect: false,
            width: '80%'
        });
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
    <script src="{{ url('/js/appAdmin.js') }}" defer></script>
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
