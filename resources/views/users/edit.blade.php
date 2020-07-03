@extends('layouts.app')

@section('title')
{{ __('Edit profil') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h2 class="card-header text-center">{{ __('Edit profil') }}</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', ['user' => $user]) }}">
                        @method('PUT')
                        @csrf
                        <div class="mb-5">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name"
                                           type="text"
                                           class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           value="{{ $user->name }}"
                                           required autocomplete="name"
                                           autofocus>

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
                                    <input id="firstname"
                                           type="text" class="form-control @error('firstname') is-invalid @enderror"
                                           name="firstname"
                                           value="{{ $user->firstname }}"
                                           required autocomplete="firstname"
                                           autofocus>

                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ __('E-Mail Address') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="email"
                                           type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email"
                                           value="{{ $user->email }}"
                                           required autocomplete="email">

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
                                    <input id="password"
                                           type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password"
                                           autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-6 offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                        <div class="row mb-3 justify-content-center">
                            @if($user->addresses()->count() > 0)
                                <h4 class="col-12 text-center mb-3">{{__('Shipping addresses')}}</h4>
                                {{-- liste des adresses connues--}}
                                <ul class="col-8 mb-0">
                                    @foreach($user->addresses as $address)
                                        <li class="d-flex justify-content-between align-items-center row">
                                            <p class="col-8 mb-0">
                                                @isset($address->pivot->name) {{$address->pivot->name}} @endisset : {{$address->number.' '.$address->road_name.', '.$address->postal_code.' '.$address->city}}
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center col-4">
                                                <a class="btn btn-primary mr-1"
                                                   href="{{ route('address.edit', ['user' => $user->id, 'address' => $address]) }}">
                                                    {{__('Edit')}}
                                                </a>
                                                <form method="POST" action="{{ route('address.destroy', ['user' => $user->id, 'address' => $address]) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="btn btn-danger"
                                                            value="delete-address">
                                                        {{__('Delete')}}
                                                    </button>
                                                </form>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="row">
                            <h4 class="col-12 text-center mb-3">{{__('Add a shipping address')}}</h4>
                            <div class="new-address col-12">
                                <form method="POST" action="{{ route('address.store', ['user' => $user->id]) }}">
                                    @method('POST')
                                    @csrf
                                            <div class="form-group row">
                                                <label for="addressName"
                                                       class="ol-form-label text-md-right col-4">
                                                    {{ __('Address name') }}
                                                </label>
                                                <div class="col-6">
                                                    <input id="addressName"
                                                           type="text"
                                                           class="form-control @error('addressName') is-invalid @enderror"
                                                           name="addressName"
                                                           autofocus>

                                                    @error('addressName')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="number" class="ol-form-label text-md-right col-4">n°</label>
                                                <div class="col-6">
                                                    <input id="number"
                                                           type="text"
                                                           class="form-control @error('addressNumber') is-invalid @enderror"
                                                           name="number" autofocus>

                                                    @error('addressNumber')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="roadName" class="ol-form-label text-md-right col-4">{{ __('Road name') }}</label>
                                                <div class="col-6">
                                                    <input id="roadName"
                                                           type="text"
                                                           class="form-control @error('roadName') is-invalid @enderror"
                                                           name="roadName"
                                                           autofocus>

                                                    @error('roadName')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="zip" class="ol-form-label text-md-right col-4">{{ __('Postal code') }}</label>
                                                <div class="col-6">
                                                    <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" autofocus>

                                                    @error('zip')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="city" class="ol-form-label text-md-right col-4">{{ __('City name') }}</label>
                                                <div class="col-6">
                                                    <input id="city"
                                                           type="text"
                                                           class="form-control @error('city') is-invalid @enderror"
                                                           name="city"
                                                           autofocus>

                                                    @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                            </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-6 offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Add shipping address') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        <a href={{ route('user.show', ['user' => $user->id]) }}>
            {{__('Back to profil')}}
        </a>
    </div>
</div>
@endsection
