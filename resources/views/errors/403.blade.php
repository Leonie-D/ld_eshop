@extends('layouts.app')

@section('title') {{ __('Access not allowed') }} @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <h1 class="col-12 text-center">{{__('Access not allowed')}}</h1>
        </div>

        <div class="row justify-content-center">
            <h2 class="col-12 text-center mb-0">{{__('Permissions are needed to access this page')}}</h2>
            <a href={{route('home')}}>{{__("Back to MaNats' home")}}</a>
        </div>
    </div>
@endsection
