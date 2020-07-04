@extends('layouts.app')

@section('title') {{__("Manage orders")}} @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h2>{{__("Manage orders")}}</h2>
                        <a class="btn btn-primary" href={{route('backoffice.admin')}}>
                            {{__('Back to dashboard')}}
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table bg-white">
                            <thead>
                            <tr>
                                <th>{{__('Order')}}</th>
                                <th>{{__('Customer')}}</th>
                                <th>{{__('Delivery option')}}</th>
                                <th>{{__('Step')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                @php
                                    if($order->step_id === 1) {
                                        $class = 'table-secondary';
                                    } else if($order->step_id === 2) {
                                        $class = 'table-info';
                                    } else if($order->step_id === 3) {
                                        $class = 'table-success';
                                    }
                                @endphp
                                <tr class="{{$class}}">
                                    <td class="align-middle col-1">{{$order->id}}</td>
                                    <td class="align-middle col-4">
                                        <div class="d-flex align-items-baseline">
                                            {{$order->user->name}} {{$order->user->firstname}}
                                            <a class="btn btn-primary ml-auto mr-4"
                                               href={{route('user.show', ['user' => $order->user])}}>
                                                {{__('See')}}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="align-middle col-3">
                                        @isset($order->address_id)
                                            {{__('Home delivery')}}
                                        @else
                                            {{__('Shop pick up')}}
                                        @endisset
                                    </td>
                                    <td class="align-middle col-4">
                                        @if($order->step_id === 1)
                                            <form method="POST"
                                                  action="{{ route('order.update', ['order' => $order]) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group row d-flex align-items-baseline mb-0">
                                                    <label for="toShipped">{{__('saved')}}</label>
                                                    <input id="toShipped"
                                                           name="updateStep"
                                                           value=2
                                                           hidden>
                                                    <button type="submit" class="btn btn-primary ml-auto mr-2">
                                                        {{ __('Mark as shipped') }}
                                                    </button>
                                                </div>
                                            </form>
                                        @elseif($order->step_id === 2)
                                            <form method="POST"
                                                  action="{{ route('order.update', ['order' => $order]) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group row d-flex align-items-baseline mb-0">
                                                    <label for="toDelivered">{{__('shipped')}}</label>
                                                    <input id="toDelivered"
                                                           name="updateStep"
                                                           value=3
                                                           hidden>
                                                    <button type="submit" class="btn btn-primary ml-auto mr-2">
                                                        {{ __('Mark as delivered') }}
                                                    </button>
                                                </div>
                                            </form>
                                        @elseif($order->step_id === 3)
                                            {{__('delivered')}}
                                        @endif
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


