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
                    @isset($deliveryAddress)
                        <p>
                            {{$deliveryAddress->number.' '.$deliveryAddress->road_name.', '.$deliveryAddress->postal_code.' '.$deliveryAddress->city}}
                        </p>
                    @else
                    
                        <form action="{{route('address.select', ['user' => auth()->user()->id])}}" method="POST">
                            @csrf
                            
                            <div class="form-group">
                                @if(auth()->user()->addresses()->count() > 0)
                                    {{-- liste des adresses connues--}}
                                    @foreach(Auth::user()->addresses as $address)
                            
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="address" id="{{'address'.$address->id}}" value="{{$address->id}}" checked>
                                            <label class="form-check-label" for="{{'address'.$address->id}}">
                                                @isset($address->pivot->name) {{$address->pivot->name}} @endisset : {{$address->number.' '.$address->road_name.', '.$address->postal_code.' '.$address->city}}
                                            </label>
                                        </div>
                            
                                    @endforeach

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="address" id="new-address" value="new">
                                        <label class="form-check-label" for="new-address">
                                            {{__('New address')}}
                                        </label>
                                    </div>

                                @endif

                                    <div class="new-address">
                                        <label for="name" class="ol-form-label text-md-right">{{ __('Address name') }}</label>
                                        <div class="">
                                            <input id="name" type="text" class="form-control @error('addressName') is-invalid @enderror" name="name" autofocus>
            
                                            @error('addressName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <label for="number" class="ol-form-label text-md-right">n°</label>
                                        <div class="">
                                            <input id="number" type="text" class="form-control @error('addressNumber') is-invalid @enderror" name="number" autofocus>
            
                                            @error('addressNumber')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <label for="roadName" class="ol-form-label text-md-right">{{ __('Road name') }}</label>
                                        <div class="">
                                            <input id="roadName" type="text" class="form-control @error('roadName') is-invalid @enderror" name="roadName" autofocus>
            
                                            @error('roadName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <label for="zip" class="ol-form-label text-md-right">{{ __('Postal code') }}</label>
                                        <div class="">
                                            <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" autofocus>
            
                                            @error('zip')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <label for="city" class="ol-form-label text-md-right">{{ __('City name') }}</label>
                                        <div class="">
                                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" autofocus>
            
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <button type="submit" class="btn btn-primary ml-auto mr-3">
                                        {{ __('Validate') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endisset
                </div>
            </div>
        </div>
        @endif

    </div>

</div>

@endsection

@section('script')

@isset($deliveryAddress)
    <form action="{{route('checkout.store', ['deliveryAddress' => $deliveryAddress])}}" method="POST">
        @csrf
        <script type="application/javascript" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{config('stripe.public_key')}}"
            data-amount="{{Session('delivery') === 'home' ? (Round(\Cart::getTotal(),2)+5)*100 : Round(\Cart::getTotal(),2)*100}}"
            data-name="{{config('app.name')}}"
            data-description="Boutique de vetements pour hommes"
            data-image=""
            data-locale="auto"
            data-currency="eur"
            data-label="{{__('Pay with card')}}"
            data-email="{{auth()->user()->email}}"
            data-allow-remember-me="false">
        </script>
        <script type="application/javascript" src="https://checkout.stripe.com/checkout.js"></script>
    </form>
@endisset

<script type="application/javascript" src="{{ asset('js/optionalForm.js') }}"></script>
@endsection