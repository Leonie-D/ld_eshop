@extends('layouts.app')

@section('title') {{ __('Order details') }} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1>{{__('Order n°')}}{{$order->id}} {{__('details')}}</h1>
        <table class="table">
            <thead>
                <tr>
                <th>{{__('Name')}}</th>
                <th>{{__('Price')}}</th>
                {{--Couleur et image...--}}
                <th>{{__('Quantity')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($order->products as $product)
                <tr>
                    <th>{{$product->name}}</th>
                    <th>{{$product->price}}</th>
                    <th>{{$product->pivot->quantity}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p>Total : {{$order->total}}€</p>
    </div>
</div>

@endsection
