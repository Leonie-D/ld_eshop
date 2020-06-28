@extends('layouts.app')

@section('title') {{ __('Page not found') }} @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <h1 class="col-12 text-center">{{__('Page not found')}}</h1>
        </div>

        <div class="row justify-content-center">
            <h2 class="col-12 text-center mb-0">{{__('Stay with us...')}}</h2>
            <a href={{route('home')}}>{{__("Back to MaNats' home")}}</a>
        </div>
    </div>
@endsection
