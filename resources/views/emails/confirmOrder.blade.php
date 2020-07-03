<h1>{{__('Your wish is our command!')}}</h1>
<p>{{__('Your order n°')}}{{$orderId}}{{__(' will be prepared carefully and shipped shortly.')}}</p>
<p>{{__('Your order :')}}</p>

<table class="table">
    <thead>
        <tr>
        <th>{{__('Name')}}</th>
        <th>{{__('Color')}}</th>
        <th>{{__('Price')}}</th>
        <th>{{__('Quantity')}}</th>
        <th>{{__('Total price')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($content as $product)
        <tr>
            <td>{{$product->name}}</td>
            <td>{{__($product->attributes['color']->name)}}</td>
            <td>{{ number_format(round($product->associatedModel->priceTtc(), 2),2) }} €</td>
            <td>{{$product->quantity}}</td>
            <td>
                {{number_format(Round($product->quantity * $product->associatedModel->priceTtc(),2),2)}} €
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<p>{{__('Total including tax')}} : {{$amount * 100}}€</p>

<p>{{__('Thank you for your confidence in MaNats.')}}</p>
