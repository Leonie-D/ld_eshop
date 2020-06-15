@extends('layouts.app')

@section('content')
<div class="container">
@isset($panier)    
        <div class="panier">
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
                    <td>{{$product->attributes['color']->name}}</td>
                    <td>{{number_format(Round($product->price,2),2)}}</td>
                    <td>
                        @if($product->quantity > 1)
                            <a href="">-</a>
                        @else
                            <a></a>
                        @endif
                    </td>
                    <td>{{$product->quantity}}</td>
                    <td>
                        @if($product->quantity < $product->associatedModel->quantity)
                            <a href="">+</a>
                        @endif
                    </td>
                    <td>{{number_format(Round($product->quantity*$product->price,2),2)}}</td>
                    <td><a href="">X</a></td>
                    </tr>
                @endforeach  
                <tr>
                    <td colspan="8"></td>
                </tr>
                <tr>
                    <td colspan="7" class="text-right">{{__('Total excluding tax')}}</td>
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

@endisset
</div>
@endsection