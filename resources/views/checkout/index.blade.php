@extends('layouts.app')

@section('title') {{__('Checkout')}} @endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{-- Rappel sur la commande --}}
        <h5>{{__('Your order :')}}</h5>
    </div>
    <div class="card-body">
        <ul>
            <li>Total :</li>
            <li>Mode de livraison : {{Session('delivery')}}</li>
            <li>Nb articles :</li>
        </ul>
    </div>
</div>

Adresse ici (si livraison domicile !)

Puis payement

@endsection