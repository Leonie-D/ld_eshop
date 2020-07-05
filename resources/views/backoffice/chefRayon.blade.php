@extends('layouts.app')

@section('title') {{__('Dashboard')}} @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="col-12 text-center mb-5">{{__('Dashboard')}}</h1>

            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h2>{{__("Manage products' stocks")}}</h2>
                        <p>{{$products->count()}} {{__('products at MaNats')}}</p>
                    </div>

                    <div class="card-body">
                        @if(isset($notifications) && $notifications->count()>0)
                            <p>{{$notifications->count()}} {{__('new product(s) out of stock')}}</p>
                            <ul>
                                @foreach($notifications as $notification)
                                    <li>
                                        {{$notification->data['product_name']}} {{$notification->data['color_name']}}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <table class="table bg-white">
                            <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Availability')}}</th>
                                <th>{{__('Add to stock')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="align-middle col-2">{{$product->name}}</td>
                                    <td class="align-middle col-1">{{number_format(round($product->priceTtc(), 2), 2)}}€</td>
                                    <td class="align-middle col-6">
                                        <ul class="mb-0">
                                            @foreach($product->colors as $color)
                                                @php
                                                    $class = $color->pivot->stock > 0 ?  'text-dark' : 'text-danger'
                                                @endphp

                                                <li class="pr-1 {{$class}} row">
                                                    {{ __($color->name) }} : {{$color->pivot->stock}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="align-middle col-3">
                                        <a class="btn btn-primary"
                                           href={{route('product.edit', ['product' => $product])}}>
                                            {{__('Add to stock')}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
