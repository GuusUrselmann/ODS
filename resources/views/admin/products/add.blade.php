@extends('adminlte::page')
@section('title', 'Product aanmaken')
@section('plugins.Select2', true)
@section('content_header')
    <h1>Nieuw Product</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-sm-9">
            <div class="card p-3">
                <div class="card-body p-0">
                    <form id="formProductAdd" class="form-product-add needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Naam</label>
                                <input type="text" class="form-control" placeholder="Naam" name="name" required>
                                <div class="invalid-feedback">
                                    Vul a.u.b. een geldige naam in.
                                </div>
                            </div>
                            <div class="form-group col-3">
                                <label>Prijs</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-euro-sign"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="00,00" name="price" required>
                                    <div class="invalid-feedback">
                                        Vul a.u.b. een geldig bedrag in.
                                    </div>
                                </div>
                           </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Beschrijving</label>
                                <textarea class="form-control" rows="3" placeholder="Beschrijving" name="description"></textarea>
                             </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Categorieën</label>
                                <select class="categories-select" multiple="multiple" name="categories[]" required>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Vul a.u.b. geldige categorieën in.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-8">
                                <label>Extra opties</label>
                                <div class="standard-extras-field" id="extraOptionsField">
                                </div>
                                <div class="standard-extra-add">
                                    <div id="addStandardExtraButton" class="btn-sm btn btn-success float-right">
                                        <b>Extra's toevoegen</b> <i class="fas fa-plus"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 float-right">
                            <button type="submit" form="formProductAdd" class="form-user-add-submit btn btn-lg btn-success mb-2">Aanmaken</button>
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
                                <button id="image-upload" class="btn btn-info">Plaatje uploaden</button>
                                <input id="image-input" type="file" name="image_path" form="formProductAdd">
                            </div>
                            <div class="form-image-preview">
                                <label>Voorbeeld:</label>
                                <img src="" class="image-preview">
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="addExtraOptionsModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Kies uw type extra opties
                </div>
                <div class="modal-body">
                    <label>Type</label>
                    <select class="type-select" name="type" id="typeSelect" required>
                        <option value="dropdown" selected>Dropdown</option>
                        <option value="multiple">Checkbox</option>
                        <option value="standardExtra">Standaard Extra</option>
                    </select>
                    <div class="standard-extra mt-3" id="standardExtra" style="display: none;">
                        <label>Standaard extra opties</label>
                        <select class="standard-extra-select" name="type" id="standardExtraSelect" required>
                            @foreach($standard_extras as $standard_extra)
                                <option data-standardextra="{{$standard_extra}}" value="{{$standard_extra->id}}" selected>{{$standard_extra->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button id="typeSelectSubmit" class="type-select-submit btn btn-sm btn-success mt-3 mb-2 float-right">Type toevoegen</button>
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
    $(document).ready(function() {

        $(".categories-select").select2({
            tags: true,
            closeOnSelect: false,
            width: '80%'
        });
        $(".type-select").select2({
            tags: true,
            width: '80%'
        });
        $(".standard-extra-select").select2({
            tags: true,
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

        $(document).on("click", ".add-option-button", function(e) {
            var optionsField = $($(e.target)[0].closest(".extra-options")).find(".options-field")[0];
            var extrasID = $($(e.target)[0].closest(".extra-options")).data("id")
            if($(optionsField).find(".option:last-child").length) {
                var nextID = $(optionsField).find(".option:last-child").data("id") + 1;
            }
            else {
                nextID = 0;
            }
            var optionAppend = `
            <div class="option" data-id="`+nextID+`">
                <div class="form-row">
                    <div class="form-group col-8">
                        <input type="text" class="form-control" placeholder="Keuze" name="extraOptions[`+extrasID+`][options][`+nextID+`][name]" required>
                    </div>
                    <div class="form-group col-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-euro-sign"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="00,00" name="extraOptions[`+extrasID+`][options][`+nextID+`][extra_amount]">
                        </div>
                    </div>
                    <div class="removeOptionButton bg-danger rounded-circle text-center" style="width: 25px; height: 25px">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
            `;
            optionsField.append($(optionAppend)[0]);

        });
        $(document).on("click", ".removeOptionButton", function(e) {
            $(e.target)[0].closest(".option").remove();
        });
    });
    $("#addStandardExtraButton").on('click', function () {
        $("#addExtraOptionsModal").modal('toggle');
    });
    $(".type-select").on("change", function(e) {
        if($(e.target)[0].value == "standardExtra") {
            $("#standardExtra").show();
        }
        else {
            $("#standardExtra").hide();
        }
    });
    $(document).on('click', "#typeSelectSubmit", function() {
        if($("#extraOptionsField .extra-options:last-child").length) {
            var nextExtrasID = $("#extraOptionsField .extra-options:last-child").data("id") + 1;
        }
        else {
            nextExtrasID = 0;
        }
        if($("#typeSelect")[0].value == "standardExtra") {
            var standardExtraData = $("#standardExtraSelect option:selected");
            var standardExtra = $(standardExtraData).data("standardextra");
            console.log(standardExtra);
            var extraOptionsAppend = `
            <div class="extra-options border-top border-secondary pt-2" data-id="`+nextExtrasID+`">
                <input type="hidden" name="extraOptions[`+nextExtrasID+`][type]" value="`+$("#typeSelect")[0].value+`">
                <input type="hidden" name="extraOptions[`+nextExtrasID+`][standardExtraID]" value="`+standardExtra.id+`">
                <div class="options-header">
                <div class="form-row mb-3">
                    <div class="form-group col-6">
                        <input type="text" value="`+standardExtra.name+`" class="form-control" disabled>
                    </div>
                    <div class="form-group col-6">
                        <b>Type: `+$("#typeSelect")[0].value+`</b>
                    </div>
                </div>
                </div>
                <div class="options-field">
            `;
            $(standardExtra.options).each(function(i,option) {
                extraOptionsAppend += `
                        <div class="option">
                            <div class="form-row">
                                <div class="form-group col-8">
                                    <input type="text" class="form-control" value="`+option.name+`" disabled>
                                </div>
                                <div class="form-group col-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-euro-sign"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control"  value="`+option.extra_amount+`" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                `;
            });
            extraOptionsAppend += `
                </div>
            </div>
            `;
        }
        else {
            var extraOptionsAppend = `
            <div class="extra-options border-top border-secondary pt-2" data-id="`+nextExtrasID+`">
                <input type="hidden" name="extraOptions[`+nextExtrasID+`][type]" value="`+$("#typeSelect")[0].value+`">
                <div class="options-header">
                <div class="form-row mb-3">
                    <div class="form-group col-6">
                        <input type="text" class="form-control" placeholder="Naam" name="extraOptions[`+nextExtrasID+`][name]" required>
                    </div>
                    <div class="form-group col-6">
                        <b>Type: `+$("#typeSelect")[0].value+`</b>
                    </div>
                </div>
                </div>
                <div class="options-field">
                    <div class="option" data-id="0">
                        <div class="form-row">
                            <div class="form-group col-8">
                                <input type="text" class="form-control" placeholder="Keuze" name="extraOptions[`+nextExtrasID+`][options][0][name]" required>
                            </div>
                            <div class="form-group col-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-euro-sign"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="00,00" name="extraOptions[`+nextExtrasID+`][options][0][extra_amount]">
                                </div>
                            </div>
                            <div class="removeOptionButton bg-danger rounded-circle text-center" style="width: 25px; height: 25px">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="options-add">
                    <div class="bg-success rounded-circle text-center add-option-button" style="width: 25px; height: 25px">
                        <i class="fas fa-plus"></i>
                    </div>
                </div>
            </div>
            `;
        }

        $("#extraOptionsField").append($(extraOptionsAppend)[0]);
        $("#addExtraOptionsModal").modal('toggle');
    });
    </script>
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
@stop
