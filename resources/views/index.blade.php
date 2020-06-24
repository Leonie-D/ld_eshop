@extends ('layouts.app')

@section('title') {{__('Home')}} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center mb-4">
        <h1 class="col-12 text-center">Men are NOT all the same</h1>
        <p class="col-12 text-center mb-0">{{__('they all have unique style')}}</p>
        <p class="col-12 text-center mb-0">{{__('we are not responsible for the rest...')}}</p>
    </div>
    <div class="row justify-content-center">
        <div class="d-flex align-items-baseline col-12 mb-4">
            <h2 class="mr-4">MaNats - {{__('New arrival')}}</h2>
            <a href="{{ route('product.index') }}">{{ __('See all new collection') }}</a>
        </div>
        <ul class="row list-unstyled">
            @foreach($someProducts as $product)
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
