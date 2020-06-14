@extends('layouts.app')

@section('title') {{__('New collection')}} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center">MaNats - {{__('New collection')}}</h1>
        <ul>
            @foreach($products as $product)
                    @include('includes.product')
            @endforeach
        </ul>
    </div>
</div>

@endsection