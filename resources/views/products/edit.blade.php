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

                <p class="d-block w-100">{{__('Availability')}}</p>
                <ul>
                    @foreach($product->colors as $key => $color)
                        @php
                            $class = $color->pivot->stock > 0 ?  'text-dark' : 'text-danger'
                        @endphp

                        <li class="pr-1 {{$class}} row">
                            <p class="col-2">{{ __($color->name) }} : {{$color->pivot->stock}}</p>

                            <form method="POST"
                                  action="{{ route('product.update', ['product' => $product, 'color' => $color]) }}"
                                  class="col-10">
                            @method('PUT')
                            @csrf
                                <div class="form-group row">
                                    <label class="col-4 text-right" for="stock">{{__('Add to stock')}}</label>
                                    <input id="stock"
                                           type="number"
                                           class="col-2"
                                           name="stock"
                                           autofocus>
                                    <button type="submit" class="btn btn-primary col-2 ml-2">
                                        {{ __('Validate') }}
                                    </button>
                                </div>
                            </form>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
        <div class="row justify-content-center text-center">
            <a href="{{ route('product.index') }}">{{ __('Back to new collection') }}</a>
        </div>
    </div>

@endsection
