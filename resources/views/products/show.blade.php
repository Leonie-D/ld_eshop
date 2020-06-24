@extends('layouts.app')

@section('title') {{ $product->name }} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center mb-5">
        <h1 class="col-8 product-name text-center mb-5">{{ $product->name }}</h1>
        <div class="col-8 d-flex flex-column">
            @include('includes.product')
        </div>
    </div>
    <div class="row justify-content-center text-center">
        <a href="{{ route('product.index') }}">{{ __('Back to new collection') }}</a>
    </div>
</div>

@endsection
