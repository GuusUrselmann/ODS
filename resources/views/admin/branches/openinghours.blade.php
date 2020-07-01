@extends('layouts.admin.layout')

@section('content')
<div class="containter">
    <div class="row">
        <div class="col-sm-8 offset-sm-1 pt-md-5">
            <h1>Filiaal Tijden</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5 offset-sm-1 pt-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Bezorgen</h3>
                    <hr>

                    <form action="" method="">

                        @foreach($delivery as $day => $hours)
                            <div class="form-row">
                                <div class="col">
                                    {{ strftime("%A", strtotime($day)) }}
                                </div>

                                <div class="col form-group">
                                    <select name="open" class="form-control">
                                        <option value="open" {{ $hours['open'] ? "selected=selected" : "" }}>Open</option>
                                        <option value="closed" {{ !$hours['open'] ? "selected=selected" : "" }}>Gesloten</option>
                                    </select>        
                                </div>

                                <div class="col form-group">
                                    <input type="text" name="{{ $day }}Open" class="form-control" value="{{ $hours['openinghour'] }}" required>
                                </div>

                                <div class="col form-group">
                                    <input type="text" name="{{ $day }}Closed" class="form-control" value="{{ $hours['closinghour'] }}" required>
                                </div>
                            </div>

                            
                        @endforeach 
                        <button type="submit" class="btn btn-primary btn-block">Opslaan</button>

                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-5 pt-md-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Afhalen</h3>
                    <hr>

                    <form action="" method="POST">
                        @csrf
                        @foreach($takeaway as $day => $hours)
                            <div class="form-row">
                                <div class="col">
                                    {{ strftime("%A", strtotime($day)) }}
                                </div>

                                <div class="col form-group">
                                    <select name="open" class="form-control">
                                        <option value="open" {{ $hours['open'] ? "selected=selected" : "" }}>Open</option>
                                        <option value="closed" {{ !$hours['open'] ? "selected=selected" : "" }}>Gesloten</option>
                                    </select>        
                                </div>

                                <div class="col form-group">
                                    <input type="text" name="{{ $day }}Open" class="form-control" value="{{ $hours['openinghour'] }}" required>
                                </div>

                                <div class="col form-group">
                                    <input type="text" name="{{ $day }}Closed" class="form-control" value="{{ $hours['closinghour'] }}" required>
                                </div>
                            </div>

                            
                        @endforeach 
                        <button type="submit" class="btn btn-primary btn-block">Opslaan</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection