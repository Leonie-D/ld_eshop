@extends('layouts.app')

@section('title') {{ __('Personal space') }} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center"> {{ __('Personal space') }} </h1>
        <ul>
            <li> 
                {{ __('Personnal information') }} 
                <ul>
                    <li>{{__('Lastname')}} : {{ $user->name }}</li>
                    <li>{{__('Firstname')}} : {{ $user->firstname }} </li>
                    <li>
                        {{__('Address(es)')}} : 
                        @if($user->addresses->count() > 0)
                            <ul>
                                @foreach($user->addresses as $address)
                                <li> {{ $address->name }} : {{ $address->number}} {{ $address->road_name}}, {{ $address->postal_code}} {{ $address->city}}</li>
                                @endforeach
                            </ul>
                        @else
                            {{__('No registered address')}}
                        @endif
                    </li>
                </ul>
            </li>
            <li>
                {{ __('Orders') }}
                A compléter !!!!!
            </li>
            <li>
                {{ __('Services') }}
                <ul>
                    <li><a href="">{{ __('Contact us') }}</a></li>
                    <li><a href="{{ route('user.edit', ['user' => $user]) }}">{{ __('Edit profil') }}</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>

@endsection