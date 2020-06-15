@extends ('layouts.app')

@section('title') {{__('Home')}} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center">Men are NOT all the same</h1>
        <p class="col-12 text-center">{{__('they all have unique style')}}</p>
        <p class="col-12 text-center">{{__('we are not responsible for the rest...')}}</p>
    </div>
    <div class="row justify-content-center">
        <h2 class="col-12 text-center">MaNats - {{__('New arrival')}}</h2>
        <ul class="row list-unstyled">
            @foreach($someProducts as $product)
                <li class="col-4 mb-4">
                    <h3> {{ $product->name }} </h3>
                    @include('includes.product')
                    <a href="{{ route('product.show', ['product' => $product]) }}">{{ __('See product') }}</a>
                </li>
            @endforeach
        </ul>
        <a href="{{ route('product.index') }}">{{ __('See all new collection') }}</a>
    </div>
</div>
@endsection