@isset($i)
    <img class="product-picture align-self-center mb-2"
         src="{{asset(Storage::url('product-img/'.$product->colors[$i]->pivot->picture.'.jpg'))}}"
         alt="{{$product->name.' image'}}">
@else
    <div class="bg-white galerie align-self-center mb-2">
        @for($i = 0; $i < $product->colors()->count(); $i++)
            <img class="product-picture align-self-center mb-2"
                 src="{{asset(Storage::url('product-img/'.$product->colors[$i]->pivot->picture.'.jpg'))}}"
                 alt="{{$product->name.' image'}}">
        @endfor
    </div>
@endisset
<p class="d-block w-100"> {{ $product->description }} </p>
<p class="d-block w-100"> {{ number_format(round($product->priceTtc() ,2),2) }}€</p>

@php
    $stockTotal = 0;
    foreach($product->colors as $color){
        $stockTotal += $color->pivot->stock;
    }
@endphp

@if($product->colors()->count()>0 && $stockTotal > 0)
    <ul class="d-flex flex-wrap mb-2 list-unstyled">
        <li class="pr-1">{{__('Available in')}}</li>
        @foreach($product->colors as $key => $color)
            @if($color->pivot->stock > 0)
                <li class="pr-1">
                    {{ __($color->name) }}@if($key < $product->colors->count()-1), @endif
                </li>
            @endif
        @endforeach
    </ul>

    <div class="dropdown-show ">
        <button class="btn btn-primary dropdown-toggle"
                type="button" id={{"dropdownMenu".$product->id}} data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
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
