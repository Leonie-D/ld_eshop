@extends('layouts.app')

@section('title') {{'Confirmation'}} @endsection

@section('content')

<div class="container min-vh-100 d-flex flex-column justify-content-between">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center">{{__('Order confirmed')}}</h1>
    </div>

    <div class="row justify-content-center">
        <h2 class="col-12 text-center mb-0">{{__('Thank you for your confidence in MaNats.')}}</h2>
        <p class="col-12 text-center mb-0">{{__('A confirmation has been sent by email.')}}</p>
        <p class="col-12 text-center mb-0">{{__('Your order will be prepared carefully and shipped shortly.')}}</p>
    </div>

    <div class="row justify-content-center mt-5">
        <h3 class="col-12 text-center">Men are NOT all the same</h3>
        <p class="col-12 text-center mb-0">{{__('they all have unique style')}}</p>
        <p class="col-12 text-center mb-0">{{__('we are not responsible for the rest...')}}</p>
    </div>

</div>
@endsection
