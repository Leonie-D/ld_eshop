@extends('layouts.app')

@section('title') {{'Confirmation'}} @endsection

@section('content')
    @if($error !== '')
        <div class="container">
            <div class="row justify-content-center">
                <h1 class="col-12 text-center">{{__('Order confirmed')}}</h1>
            </div>

            <div class="row justify-content-center mt-5">
                <h2 class="col-12 text-center mb-0">{{__('Thank you for your confidence in MaNats.')}}</h2>
                <p class="col-12 text-center mb-0">{{__('A confirmation has been sent by email.')}}</p>
                <p class="col-12 text-center mb-5">{{__('Your order will be prepared carefully and shipped shortly.')}}</p>
            </div>

            <div class="row justify-content-center mt-5">
                <h3 class="col-12 text-center mt-5">Men are NOT all the same</h3>
                <p class="col-12 text-center mb-0">{{__('they all have unique style')}}</p>
                <p class="col-12 text-center mb-0">{{__('we are not responsible for the rest...')}}</p>
            </div>
        </div>
    @else
        <div class="container min-vh-100 d-flex flex-column justify-content-between">
            <div class="row justify-content-center">
                <h1 class="col-12 text-center">{{__('Order could not be confirmed...')}}</h1>
                <a href="">{{__('Please contact us')}}</a>
            </div>
        </div>
    @endif

    <div class="row justify-content-center mt-5">
        <a class="btn btn-primary" href={{route('home')}}>{{__("Back to MaNats' home")}}</a>
    </div>

@endsection
