@extends('layouts.orderwindow.layout')

@section('content')
    <orderwindow :orderlist="{{$orders}}">
@endsection
