@extends('layouts.app')

@section('title') {{ __($category->name) }} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 d-flex justify-content-between align-items-baseline">
            <a href={{route('category.show', ['category' => $previousCategory])}}>
                &larr; {{$previousCategory->name}}
            </a>
            <h1 class="text-center"> {{ __($category->name) }} </h1>
            <a href={{route('category.show', ['category' => $nextCategory])}}>
                {{$nextCategory->name}} &rarr;
            </a>
        </div>

        <ul class="row list-unstyled">
            @foreach($category->products as $product)
                @php
                    /*Un peu d'aléatoire pour ne pas avoir tous les produits dans la première couleur disponible*/
                    if($product->colors()->count() > 0) {
                        $i = rand(0, $product->colors()->count()-1);
                    }
                @endphp
                <li class="col-4 mb-4">
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
