@extends('layouts.app')

@section('title') {{__('Cart confirmation')}} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            {{-- inscription ou connexion --}}
            mode livraison retenu : {{$delivery}}
        </div>
    </div>
</div>

@endsection