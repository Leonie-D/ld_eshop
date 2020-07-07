@extends('layouts.app')

@section('title') {{ __('Order details') }} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="mb-5">{{__('Order n°')}}{{$order->id}} {{__('details')}}</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>{{__('Name')}}</th>
                    <th>{{__('Color')}}</th>
                    <th>{{__('Picture')}}</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('Quantity')}}</th>
                    <th>{{__('Total')}}</th>
                </tr>
            </thead>
            <tbody>
            @foreach($panier as $item)
                <tr>
                    <td class="align-middle">{{$item["itemName"]}}</td>
                    <td class="align-middle">{{$item["itemColor"]}}</td>
                    <td class="align-middle">
                        <img class="cart-picture"
                             src="{{asset(Storage::url('product-img/'.$item["itemPicture"].'.jpg'))}}"
                             alt="{{$item["itemName"].' image'}}">
                    </td>
                    <td class="align-middle">{{number_format(round($item["itemPrice"],2),2)}}€</td>
                    <td class="align-middle">{{$item["itemQuantity"]}}</td>
                    <td class="align-middle">{{number_format(round($item["itemPrice"]*$item["itemQuantity"],2),2)}}€</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="6"></td>
                </tr>
                @isset($order->address_id)
                <tr>
                    <td colspan="5" class="text-right">{{__('Home delivery')}}</td>
                    <td colspan="1">5€</td>
                </tr>
                @endisset
                <tr>
                    <td colspan="5" class="text-right">{{__('Total including tax')}}</td>
                    @isset($order->address_id)
                        <td colspan="1">{{$order->total + 5}}€</td>
                    @else
                        <td colspan="1">{{$order->total}}€</td>
                    @endisset
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row justify-content-center">
        <a href={{ route('user.show', ['user' => $order->user->id]) }}>
            {{__('Back to profil')}}
        </a>
    </div>
</div>

@endsection