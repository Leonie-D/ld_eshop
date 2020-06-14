{{-- image --}}
<p class="d-block w-100"> Description : {{ $product->description }} </p>
@if($product->colors()->count()>0)
    <div class="d-flex">
        <p class="pr-1"> Disponible en </p>
        <ul class="d-flex list-unstyled">
            @foreach($product->colors as $key => $color)
            <li class="pr-1"> 
                {{ __($color->name) }}@if($key < $product->colors->count()-1), @endif
            </li>
            @endforeach
        </ul> 
    </div>
@else
    <p>Momentanément indisponible</p>
@endif
<p class="d-block w-100"> {{ number_format(round($product->price * (1 + $product->tax->value), 2),2) }}€</p>