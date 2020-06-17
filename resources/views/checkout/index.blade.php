@extends('layouts.app')

@section('title') {{__('Checkout')}} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="card">
            <div class="card-header">
                {{-- Rappel sur la commande --}}
                <h5>{{__('Your order :')}}</h5>
            </div>
            <div class="card-body">
                <ul>
                    <li>
                        @if(Session('delivery') === 'home')
                            {{__('Total including tax and delivery')}} : {{number_format(Round(\Cart::getTotal(),2),2) + 5}} €
                        @else
                            {{__('Total including tax and delivery')}} : {{number_format(Round(\Cart::getTotal(),2),2)}} €
                        @endif
                    </li>
                    <li>
                        @if(Session('delivery') === 'home')
                            {{__('Delivery option')}} : {{__('Home delivery')}}
                        @else
                            {{__('Delivery option')}} : {{__('Shop pick up')}}
                        @endif
                    </li>
                    <li>{{__('Total articles number')}} : {{\Cart::getTotalQuantity()}}</li>
                </ul>
            </div>
        </div>

        @if(Session('delivery') === 'home')
        <div class="card">
            <div class="card-header">
                {{-- Adresse de livraison --}}
                <h5>{{__('Delivery address :')}}</h5>
            </div>
            <div class="card-body">
                {{dd(auth()->user()->addresses()->count())}}
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                {{-- Informations de payement--}}
                <h5>{{__('czejncjg :')}}</h5>
            </div>
            <div class="card-body">
                
            </div>
        </div>

    </div>
</div>
@endsection