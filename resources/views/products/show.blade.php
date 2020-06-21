@extends('layouts.app')

@section('title') {{ $product->name }} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center text-center">
        <h1 class="col-12 product-name">{{ $product->name }}</h1>
        @include('includes.product')
    </div>
    <div class="row justify-content-center text-center">
        <a href="{{ route('product.index') }}">{{ __('Back to new collection') }}</a>
    </div>
</div>

@endsection