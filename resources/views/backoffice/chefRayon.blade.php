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
                                    <td class="col-2">{{$product->name}}</td>
                                    <td class="col-1">{{number_format(round($product->priceTtc(), 2), 2)}}€</td>
                                    <td class="col-6">

                                    </td>
                                    <td class="col-3">

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
