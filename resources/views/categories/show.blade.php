@extends('layouts.app')

@section('title') {{ __($category->name) }} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center"> {{ __($category->name) }} </h1>
        <ul class="row list-unstyled">
            @foreach($category->products as $product)
                <li class="col-4 mb-4">
                    <h3> {{ $product->name }} </h3>
                    @include('includes.product')
                    <a href="{{ route('product.show', ['product' => $product]) }}">{{ __('See product') }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection