@extends('layouts.guest.layout')

@section('content')
    <div class="container order">
        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10">
                <orderlist :cart="{{$cart}}" :amounttotal="{{$cart_amount}}" />
            </div>
            <div class="col-1">
            </div>
        </div>
    </div>
@endsection
