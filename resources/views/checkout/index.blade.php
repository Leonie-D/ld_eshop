@extends('layouts.app')

@section('title') {{__('Checkout')}} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-around">

        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    {{-- Rappel sur la commande --}}
                    <h5>{{__('Your order')}}</h5>
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
        </div>

        @if(Session('delivery') === 'home')
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    {{-- Adresse de livraison --}}
                    <h5>{{__('Delivery address')}}</h5>
                </div>
                <div class="card-body">
                    @if(auth()->user()->addresses()->count() > 0)
                        liste des adresses...
                    @endif
                        nouvelle adresse -> à enregistrer dans la bdd
                </div>
            </div>
        </div>
        @endif

    </div>

</div>

@endsection

@section('script')
<form action="{{route('checkout.store')}}" method="POST">
    @csrf
    <script type="application/javascript" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{config('stripe.public_key')}}"
        data-amount={{Round(\Cart::getTotal()*100,0)}} {{--en centimes--}}
        data-name="{{config('app.name')}}"
        data-description="Boutique de vetements pour hommes"
        data-image=""
        data-locale="auto"
        data-currency="eur"
        data-label="{{__('Pay with card')}}">
    </script>
    <script type="application/javascript" src="https://checkout.stripe.com/checkout.js"></script>
</form>
@endsection