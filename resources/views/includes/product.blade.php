{{-- image --}}
<p class="d-block w-100"> {{ $product->description }} </p>
<p class="d-block w-100"> {{ number_format(round($product->price * (1 + $product->tax->value), 2),2) }}€</p>

@php
    $stockTotal = 0;
    foreach($product->colors as $color){
        $stockTotal += $color->pivot->stock;
    }
@endphp

@if($product->colors()->count()>0 && $stockTotal > 0)
    <div class="d-flex">
        <p class="pr-1"> {{__('Available in')}} </p>
        <ul class="d-flex list-unstyled">
            @foreach($product->colors as $key => $color)
                @if($color->pivot->stock > 0)
                    <li class="pr-1"> 
                        {{ __($color->name) }}@if($key < $product->colors->count()-1), @endif
                    </li>
                @endif
            @endforeach
        </ul> 
    </div>

    <div class="dropdown-show">   
        <button class="btn btn-primary dropdown-toggle" type="button" id={{"dropdownMenu".$product->id}} data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('Add to cart') }}
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby={{"dropdownMenu".$product->id}}>
            @foreach($product->colors as $key => $color)
                <a class="dropdown-item" href=" {{ route('panier.add', ['product' => $product, 'color' => $color]) }}"> 
                    {{ __($color->name) }}
                </a>
            @endforeach
        </div>
    </div>

@else

<p> {{__('Temporarily unavailable')}} </p>
<div class="dropdown-show">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" disabled>
        {{ __('Add to cart') }}
    </button>
</div>

@endif