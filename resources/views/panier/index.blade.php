@extends('layouts.app')

@section('content')
<div class="container">
@isset($panier)  

        <div class="panier text-center">
            <table class="table">
                <thead>
                    <tr>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Color')}}</th>
                    <th>{{__('Price')}}</th>
                    <th>-</th>
                    <th>{{__('Quantity')}}</th>
                    <th>+</th>
                    <th>{{__('Total price')}}</th>
                    <th>{{__('Delete')}}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($panier as $product)  
                    <tr>
                        <td>{{$product->name}}</td>
                        <td>{{__($product->attributes['color']->name)}}</td>
                        <td>{{ number_format(round($product->price * (1 + $product->associatedModel->tax->value), 2),2) }} €</td>
                        <td>
                            @if($product->quantity > 1)
                                <a href="{{ route('panier.update', ['productId' => $product->id, 'method' => '-']) }}">-</a>
                            @else
                                <a></a>
                            @endif
                        </td>
                        <td>{{$product->quantity}}</td>
                        <td>
                            @if($product->quantity < 10)
                                <a href="{{ route('panier.update', ['productId' => $product->id, 'method' => '+']) }}">+</a>
                            @endif
                        </td>
                        <td>
                            {{number_format(Round($product->getPriceSum() * (1 + $product->associatedModel->tax->value),2),2)}} €
                        </td>
                        <td><a href="{{ route('panier.remove', ['productId' => $product->id]) }}">X</a></td>
                    </tr>
                @endforeach  
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right">{{__('Total excluding tax')}}</td>
                    {{-- Je ne suis pas parvenue à affecter la condition par item au total uniquement... --}}
                    <td colspan="1">{{number_format(Round(\Cart::getSubTotal(),2),2)}} €</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right">{{__('Tax')}}</td>
                    <td colspan="1">{{number_format(Round(\Cart::getTotal()-\Cart::getSubTotal(),2),2)}} €</td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right">{{__('Total including tax')}}</td>
                    <td colspan="1">{{number_format(Round(\Cart::getTotal(),2),2)}} €</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <a class="btn btn-primary" href="{{ route('panier.confirm') }}">{{__('Confirm order')}}</a>
        </div>

@endisset
</div>
@endsection