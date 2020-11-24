@extends('adminlte::page')
@section('title', 'Instellingen')
@section('plugins.Select2', true)
@section('content_header')
    <h1><a class="h6" href="{{url()->previous()}}"><i class="fas fa-arrow-left"></i></a> Instellingen - Openingstijden</h1>
@stop
@section('content')
<form id="formSettings" class="form-settings needs-validation" method="POST" action="" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card p-3">
                <div class="card-body p-0">
                    <h4>Afhalen</h4>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Maandag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[takeaway][monday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'takeaway', $day = 'monday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'takeaway', $day = 'monday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'takeaway', $day = 'monday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][monday][from]" value="{{$branch->openingHours($type = 'takeaway', $day = 'monday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][monday][till]" value="{{$branch->openingHours($type = 'takeaway', $day = 'monday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Dinsdag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[takeaway][tuesday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'takeaway', $day = 'tuesday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'takeaway', $day = 'tuesday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'takeaway', $day = 'tuesday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][tuesday][from]" value="{{$branch->openingHours($type = 'takeaway', $day = 'tuesday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][tuesday][till]" value="{{$branch->openingHours($type = 'takeaway', $day = 'tuesday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Woensdag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[takeaway][wednesday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'takeaway', $day = 'wednesday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'takeaway', $day = 'wednesday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'takeaway', $day = 'wednesday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][wednesday][from]" value="{{$branch->openingHours($type = 'takeaway', $day = 'wednesday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][wednesday][till]" value="{{$branch->openingHours($type = 'takeaway', $day = 'wednesday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Donderdag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[takeaway][thursday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'takeaway', $day = 'thursday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'takeaway', $day = 'thursday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'takeaway', $day = 'thursday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][thursday][from]" value="{{$branch->openingHours($type = 'takeaway', $day = 'thursday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][thursday][till]" value="{{$branch->openingHours($type = 'takeaway', $day = 'thursday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Vrijdag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[takeaway][friday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'takeaway', $day = 'friday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'takeaway', $day = 'friday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'takeaway', $day = 'friday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][friday][from]" value="{{$branch->openingHours($type = 'takeaway', $day = 'friday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][friday][till]" value="{{$branch->openingHours($type = 'takeaway', $day = 'friday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Zaterdag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[takeaway][saturday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'takeaway', $day = 'saturday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'takeaway', $day = 'saturday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'takeaway', $day = 'saturday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][saturday][from]" value="{{$branch->openingHours($type = 'takeaway', $day = 'saturday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][saturday][till]" value="{{$branch->openingHours($type = 'takeaway', $day = 'saturday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Zondag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[takeaway][sunday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'takeaway', $day = 'sunday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'takeaway', $day = 'sunday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'takeaway', $day = 'sunday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][sunday][from]" value="{{$branch->openingHours($type = 'takeaway', $day = 'sunday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[takeaway][sunday][till]" value="{{$branch->openingHours($type = 'takeaway', $day = 'sunday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card p-3">
                <div class="card-body p-0">
                    <h4>Bezorgen</h4>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Maandag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[delivery][monday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'delivery', $day = 'monday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'delivery', $day = 'monday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'delivery', $day = 'monday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][monday][from]" value="{{$branch->openingHours($type = 'delivery', $day = 'monday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][monday][till]" value="{{$branch->openingHours($type = 'delivery', $day = 'monday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Dinsdag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[delivery][tuesday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'delivery', $day = 'tuesday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'delivery', $day = 'tuesday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'delivery', $day = 'tuesday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][tuesday][from]" value="{{$branch->openingHours($type = 'delivery', $day = 'tuesday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][tuesday][till]" value="{{$branch->openingHours($type = 'delivery', $day = 'tuesday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Woensdag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[delivery][wednesday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'delivery', $day = 'wednesday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'delivery', $day = 'wednesday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'delivery', $day = 'wednesday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][wednesday][from]" value="{{$branch->openingHours($type = 'delivery', $day = 'wednesday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][wednesday][till]" value="{{$branch->openingHours($type = 'delivery', $day = 'wednesday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Donderdag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[delivery][thursday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'delivery', $day = 'thursday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'delivery', $day = 'thursday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'delivery', $day = 'thursday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][thursday][from]" value="{{$branch->openingHours($type = 'delivery', $day = 'thursday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][thursday][till]" value="{{$branch->openingHours($type = 'delivery', $day = 'thursday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Vrijdag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[delivery][friday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'delivery', $day = 'friday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'delivery', $day = 'friday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'delivery', $day = 'friday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][friday][from]" value="{{$branch->openingHours($type = 'delivery', $day = 'friday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][friday][till]" value="{{$branch->openingHours($type = 'delivery', $day = 'friday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Zaterdag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[delivery][saturday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'delivery', $day = 'saturday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'delivery', $day = 'saturday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'delivery', $day = 'saturday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][saturday][from]" value="{{$branch->openingHours($type = 'delivery', $day = 'saturday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][saturday][till]" value="{{$branch->openingHours($type = 'delivery', $day = 'saturday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="openinghours-row row mb-2">
                        <div class="col-3">
                            Zondag
                        </div>
                        <div class="col-3">
                            <select class="openclose-select" name="opening_hours[delivery][sunday][open]" required>
                                <option value="open" {{$branch->openingHours($type = 'delivery', $day = 'sunday')->first()->open == true ? 'selected' : ''}}>Open</option>
                                <option value="closed" {{$branch->openingHours($type = 'delivery', $day = 'sunday')->first()->open == false ? 'selected' : ''}}>Gesloten</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <div class="form-row {{$branch->openingHours($type = 'delivery', $day = 'sunday')->first()->open == false ? 'd-none' : ''}}">
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][sunday][from]" value="{{$branch->openingHours($type = 'delivery', $day = 'sunday')->first()->from}}" type="text">
                                </div>
                                <div class="col-2">
                                    <h5>tot</h5>
                                </div>
                                <div class="col-5">
                                    <input class="timepicker form-control" name="opening_hours[delivery][sunday][till]" value="{{$branch->openingHours($type = 'delivery', $day = 'sunday')->first()->till}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-10 col-2 float-right">
            <button type="submit" class="form-user-add-submit btn btn-lg btn-success mb-2">Opslaan</button>
        </div>
    </div>
</form>
@stop
@section('css')
    <link rel="stylesheet" href="{{asset('/css/adminPages.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
@stop
@section('js')
    <script>
        $(".openclose-select").select2({
            tags: true,
            width: '80%'
        });
        $(".openclose-select").on('change', function(e) {
            $(e.target).closest('.openinghours-row').find('.form-row').toggleClass('d-none');
            console.log(e.target.value);
        });
    </script>
    <script src="{{ url('/js/utilities/form-validation.js') }}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" defer>
        $('.timepicker').datetimepicker({
            format: 'HH:mm',
            icons: {
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                next: 'fa fa-chevron-right',
                previous: 'fa fa-chevron-left'
            }
        });
    </script>
@stop
