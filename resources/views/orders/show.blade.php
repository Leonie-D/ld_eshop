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
                <th>{{__('Color')}}</th>
                <th>{{__('Picture')}}</th>
                <th>{{__('Price')}}</th>
                <th>{{__('Quantity')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($order->products as $product)
                <th>{{$product->name}}</th>
                <th>{{$product->pivot->color_id}}</th>
                <th>{{$product->picture}}</th>
                <th>{{$product->price}}</th>
                <th>{{$product->pivot->quantity}}</th>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection