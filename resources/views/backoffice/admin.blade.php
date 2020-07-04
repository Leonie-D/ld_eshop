@extends('layouts.app')

@section('title') {{__('Dashboard')}} @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="col-12 text-center mb-5">{{__('Dashboard')}}</h1>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">{{__("Manage customers' accounts")}}</div>

                    <div class="card-body">
                        <p>{{$users->count()}} {{__('registered users')}}</p>

                        @if(isset($customerNotifications) && $customerNotifications->count()>0)
                            <p>{{$customerNotifications->count()}} {{__('new users')}}</p>
                            <ul>
                                @foreach($customerNotifications as $notification)
                                    <li>
                                        {{$notification->data['name']}} {{$notification->data['firstname']}}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <a href={{route('user.index', compact('users'))}}>{{__("Manage customers' accounts")}}</a>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card">
                    <div class="card-header">{{__("Manage orders")}}</div>

                    <div class="card-body">
                        <ul>
                            <li>{{$orders->where('step_id', 1)->count()}} {{__('saved order(s)')}}</li>
                            <li>{{$orders->where('step_id', 2)->count()}} {{__('shipped order(s)')}}</li>
                            <li>{{$orders->where('step_id', 3)->count()}} {{__('delivered order(s)')}}</li>
                        </ul>

                        @if(isset($orderNotifications) && $orderNotifications->count()>0)
                            <p>{{$orderNotifications->count()}} {{__('new orders')}}</p>
                        @endif

                        <a href={{route('order.index', compact('orders'))}}>{{__("Manage orders")}}</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
