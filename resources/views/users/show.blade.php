@extends('layouts.app')

@section('title') {{ __('Personal space') }} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center mb-5"> {{ __('Personal space') }} </h1>
            <div class="col-4">
                <div class="card mb-3">
                    <h4 class="card-header">{{ __('Personnal information') }}</h4>
                    <ul class="list-unstyled card-body">
                        <li>{{__('Lastname')}} : {{ $user->name }}</li>
                        <li>{{__('Firstname')}} : {{ $user->firstname }} </li>
                        <li>
                            {{__('Address(es)')}} :
                            @if($user->addresses->count() > 0)
                                <ul>
                                    @foreach($user->addresses as $address)
                                        <li>
                                            {{ $address->pivot->name }} : {{ $address->number}} {{ $address->road_name}}, {{ $address->postal_code}} {{ $address->city}}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                {{__('No registered address')}}
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <h4 class="card-header">{{ __('Services') }}</h4>
                    <ul class="list-unstyled card-body">
                        <li><a href={{route('contact')}}>{{ __('Contact us') }}</a></li>
                        <li><a href="{{ route('user.edit', ['user' => $user]) }}">{{ __('Edit profil') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <h4 class="card-header">{{ __('Orders') }}</h4>
                    @if($user->orders()->count() > 0)
                        <ul class="list-unstyled card-body d-flex flex-column-reverse">
                            @foreach($user->orders as $order)
                                <li class="d-flex">
                                    <p class="mb-1">{{__('Order n°')}}{{$order->id}} : {{$order->total}}€ / {{__($order->step->name)}}</p>
                                    <a class="ml-auto" href={{route('order.show', ['order' => $order])}}>
                                        {{__('See details')}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="card-body">{{__('No order... yet !')}}</p>
                    @endif
                </div>
            </div>
    </div>
</div>

@endsection
