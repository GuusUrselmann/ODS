@extends('layouts.emails.layout')

@section('content')
    <div style="width: 100%; background-color: #000; color: #fff;">
        {{$order->id}}
        <a href="{{url('/bestelling/volgen/'.$order->uuid)}}">Bestelling volgen</a>
    </div>
@endsection
