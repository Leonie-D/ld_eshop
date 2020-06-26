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
                    <th>{{__('Total')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($panier as $item)
                <tr>
                    <th>{{$item["itemName"]}}</th>
                    <th>{{$item["itemColor"]}}</th>
                    <th>{{$item["itemPicture"]}}</th>
                    <th>{{$item["itemPrice"]}}</th>
                    <th>{{$item["itemQuantity"]}}</th>
                    <th>{{$item["itemPrice"]*$item["itemQuantity"]}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p>Total : {{$order->total}}€</p>
    </div>
</div>

@endsection
