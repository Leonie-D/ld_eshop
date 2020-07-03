@extends('layouts.app')

@section('title') {{__('Edit')}} {{ $product->name }} @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <h1 class="col-8 product-name text-center mb-5">{{ $product->name }}</h1>
            <div class="col-8 d-flex flex-column">

                <div class="bg-white galerie align-self-center mb-2">
                    @for($i = 0; $i < $product->colors()->count(); $i++)
                        <img class="product-picture align-self-center mb-2"
                             src="{{asset(Storage::url('product-img/'.$product->colors[$i]->pivot->picture.'.jpg'))}}"
                             alt="{{$product->name.' image'}}">
                    @endfor
                </div>

                <p class="d-block w-100"> {{ $product->description }} </p>
                <p class="d-block w-100"> {{ number_format(round($product->priceTtc() ,2),2) }}€</p>

                <ul class="d-flex flex-wrap mb-2 list-unstyled">
                    <li class="pr-1">{{__('Availability')}}</li>
                    <ul>
                        @foreach($product->colors as $key => $color)
                            @php
                                $class = $color->pivot->stock > 0 ?  'text-dark' : 'text-danger'
                            @endphp
                            <li class="pr-1 {{$class}}">
                                {{ __($color->name) }} : {{$color->pivot->stock}}
                            </li>
                        @endforeach
                    </ul>
                </ul>

            </div>
        </div>
        <div class="row justify-content-center text-center">
            <a href="{{ route('product.index') }}">{{ __('Back to new collection') }}</a>
        </div>
    </div>

@endsection
