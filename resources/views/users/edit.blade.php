@extends('layouts.app')

@section('title')
{{ __('Edit profil') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit profil') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', ['user' => $user]) }}">
                        @method('PUT')
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Firstname') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            
                            @if($user->addresses()->count() > 0)
                                <p>{{__('Shipping addresses')}}</p>
                                {{-- liste des adresses connues--}}
                                <ul>
                                    @foreach($user->addresses as $address)
                                        <li>
                                            <p>
                                                @isset($address->pivot->name) {{$address->pivot->name}} @endisset : {{$address->number.' '.$address->road_name.', '.$address->postal_code.' '.$address->city}}
                                            </p>
                                            <a href="{{ route('address.edit', ['user' => $user->id, 'address' => $address]) }}">
                                                {{__('Edit')}}
                                            </a>
                                            <a href="{{ route('address.destroy', ['user' => $user->id, 'address' => $address]) }}" 
                                                onclick="event.preventDefault();
                                                            document.getElementById('address-delete-form').submit();">
                                                {{__('Delete')}}
                                            </a>
                                        </li>                        
                                    @endforeach
                                </ul>

                            @endif

                            <p>
                                {{__('Add a shipping address')}}
                            </p>

                                <div class="new-address">
                                    <label for="addressName" class="ol-form-label text-md-right">{{ __('Address name') }}</label>
                                    <div class="">
                                        <input id="addressName" type="text" class="form-control @error('addressName') is-invalid @enderror" name="addressName" autofocus>
        
                                        @error('addressName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label for="number" class="ol-form-label text-md-right">n°</label>
                                    <div class="">
                                        <input id="number" type="text" class="form-control @error('addressNumber') is-invalid @enderror" name="number" autofocus>
        
                                        @error('addressNumber')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label for="roadName" class="ol-form-label text-md-right">{{ __('Road name') }}</label>
                                    <div class="">
                                        <input id="roadName" type="text" class="form-control @error('roadName') is-invalid @enderror" name="roadName" autofocus>
        
                                        @error('roadName')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label for="zip" class="ol-form-label text-md-right">{{ __('Postal code') }}</label>
                                    <div class="">
                                        <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" autofocus>
        
                                        @error('zip')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <label for="city" class="ol-form-label text-md-right">{{ __('City name') }}</label>
                                    <div class="">
                                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" autofocus>
        
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <form id="address-delete-form" action="{{ route('address.destroy', ['address' => $address, 'user' => $user->id]) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
