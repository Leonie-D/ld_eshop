@extends('layouts.app')

@section('title') {{ __($category->name) }} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center"> {{ __($category->name) }} </h1>
        <ul class="row list-unstyled">
            @foreach($category->products as $product)
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
