@extends('layouts.app')

@section('title') {{__('New collection')}} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center mb-5">MaNats - {{__('New collection')}}</h1>
        <ul class="row list-unstyled">
            @foreach($products as $product)
                @php
                    /*Un peu d'aléatoire pour ne pas avoir tous les produits dans la première couleur disponible*/
                    if($product->colors()->count() > 0) {
                        $i = rand(0, $product->colors()->count()-1);
                    }
                @endphp
                <li class="col-3 mb-4">
                    <div class="card h-100">
                        <h3 class="product-name card-header text-center"> {{ $product->name }} </h3>
                        <div class="card-body d-flex flex-column">
                            @include('includes.product')
                            <a href="{{ route('product.show', ['product' => $product]) }}">{{ __('See product') }}</a>
                        </div>
                    </div>

                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection
