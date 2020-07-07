@extends('layouts.app')

@section('title') {{__('Contact us')}} @endsection

@section('content')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <h1>{{__('Contact us')}}</h1>
        </div>
        <div class="row text-center mb-4">
            <h3 class="col-12">{{__('By phone')}}</h3>
            <p class="col-12">{{__('Learn more about our products, please contact one of our customer advisors :')}} 03 20 12 34 56</p>
            <p class="col-12">{{__('For claims, please contact our customer service :')}} 0 800 123 456</p>
        </div>
        <div class="row text-center mb-4">
            <h3 class="col-12">{{__('By mail')}}</h3>
            <p class="col-12">{{__('Send us an email at :')}} contact@manats.fr</p>
        </div>
        <div class="row text-center mb-4">
            <h3 class="col-12">{{__('To come and see us')}}</h3>
            <p class="col-12">{{__('Find our shop at')}} 35 rue Neuve, 59000 Lille</p>
        </div>
        <div class="row justify-content-center mb-4">
            <a class="btn btn-primary" href={{route('home')}}>{{__("Back to MaNats' home")}}</a>
        </div>
    </div>
@endsection
