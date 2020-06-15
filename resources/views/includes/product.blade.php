{{-- image --}}
<p class="d-block w-100"> {{ $product->description }} </p>
<p class="d-block w-100"> {{ number_format(round($product->price * (1 + $product->tax->value), 2),2) }}€</p>
@if($product->colors()->count()>0)

    <div class="d-flex">
        <p class="pr-1"> {{__('Available in')}} </p>
        <ul class="d-flex list-unstyled">
            @foreach($product->colors as $key => $color)
            <li class="pr-1"> 
                {{ __($color->name) }}@if($key < $product->colors->count()-1), @endif
            </li>
            @endforeach
        </ul> 
    </div>

    <button class="btn btn-primary add-cart-button dropdown-toggle" type="button" id={{"dropdownMenu".$product->id}} data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Add to cart') }}
    </button>
    <div class="dropdown-menu" aria-labelledby={{"dropdownMenu".$product->id}}>
        @foreach($product->colors as $key => $color)
            <a class="dropdown-item" href=" {{ route('panier.add', ['product' => $product, 'color' => $color]) }}"> 
                {{ __($color->name) }}
            </a>
        @endforeach
    </div>

@else

<p> {{__('Temporarily unavailable')}} </p>

<button class="btn btn-primary add-cart-button dropdown-toggle" type="button" data-toggle="dropdown" disabled>
    {{ __('Add to cart') }}
</button>

@endif