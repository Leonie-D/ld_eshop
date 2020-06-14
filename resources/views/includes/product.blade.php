@if($product->colors()->count()>0)
<li>
    <h3> {{$product->name}} </h3>
    <p> Description : {{$product->description}} </p>
    <p> Disponible en : </p>
    <ul>
        @foreach($product->colors as $color)
        <li>
            {{$color->name}}
        </li>
        @endforeach
    </ul>
    <p> {{$product->price * (1 + $product->tax->value)}}€</p> 
</li>
@endif