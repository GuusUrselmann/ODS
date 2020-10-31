@extends('adminlte::page')
@section('title', 'Standaard extra aanmaken')
@section('plugins.Select2', true)
@section('content_header')
    <h1>Nieuw Standaard Extra</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formStandardExtraAdd" class="form-standard-extra-add needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Naam</label>
                                <input type="text" class="form-control" placeholder="Naam" name="name" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige naam in.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-2">
                                <label>Type</label>
                                <select class="type-select" name="type" id="typeSelect" required>
                                    <option value="dropdown" selected>Dropdown</option>
                                    <option value="multiple">Checkbox</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Opties</label>
                                <div id="optionsField" class="options-field">
                                    <div class="option" data-id="0">
                                        <div class="form-row">
                                            <div class="form-group col-8">
                                                <input type="text" class="form-control" placeholder="Keuze" name="extra_options[0][name]" required>
                                            </div>
                                            <div class="form-group col-4">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-euro-sign"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="00,00" name="extra_options[0][extra_amount]">
                                                </div>
                                            </div>
                                            <div class="removeOptionButton bg-danger rounded-circle text-center" style="width: 25px; height: 25px">
                                                <i class="fas fa-times"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="options-add">
                                    <div id="addOptionButton" class="bg-success rounded-circle text-center" style="width: 25px; height: 25px">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 float-right">
                            <button type="submit" form="formStandardExtraAdd" class="form-standard-extra-add-submit btn btn-lg btn-success mb-2">Aanmaken</button>
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
        $(".type-select").select2({
            tags: true,
            width: '80%'
        });

        $("#addOptionButton").on("click", function() {
            var optField = $("#optionsField")[0];
            if($("#optionsField .option:last-child").length) {
                var nextID = $("#optionsField .option:last-child").data("id") + 1;
            }
            else {
                nextID = 0;
            }
            var optionAppend = `
            <div class="option" data-id="`+nextID+`">
                <div class="form-row">
                    <div class="form-group col-8">
                        <input type="text" class="form-control" placeholder="Keuze" name="extra_options[`+nextID+`][name]" required>
                    </div>
                    <div class="form-group col-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-euro-sign"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="00,00" name="extra_options[`+nextID+`][extra_amount]">
                        </div>
                    </div>
                    <div class="removeOptionButton bg-danger rounded-circle text-center" style="width: 25px; height: 25px">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
            `;
            optField.append($(optionAppend)[0]);
        });
        $(document).on("click", ".removeOptionButton", function(e) {
            $(e.target)[0].closest(".option").remove();
        });
    });
    </script>
    <script src="{{ url('/js/appAdmin.js') }}" defer></script>
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
