@extends('layouts.app')

@section('title')
{{ __('Edit shipping address') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit shipping address') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('address.update', ['user' => $userId, 'address' => $address]) }}">
                        @method("PUT")
                        @csrf

                        <input id="userId" type="text" value="" class="form-control" name="userId" hidden>

                        <div class="form-group row">
                            <label for="addressName" class="ol-form-label text-md-right col-4">{{ __('Address name') }}</label>
                            <div class="col-6">
                                <input id="addressName" type="text" value={{$addressName}} class="form-control @error('addressName') is-invalid @enderror" name="addressName" autofocus>

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
                                <input id="number" type="text" value={{$address->number}} class="form-control @error('addressNumber') is-invalid @enderror" name="number" autofocus>

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
                                <input id="roadName" type="text" value={{$address->road_name}} class="form-control @error('roadName') is-invalid @enderror" name="roadName" autofocus>

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
                                <input id="zip" type="text" value={{$address->postal_code}} class="form-control @error('zip') is-invalid @enderror" name="zip" autofocus>

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
                                <input id="city" type="text" value={{$address->city}} class="form-control @error('city') is-invalid @enderror" name="city" autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
