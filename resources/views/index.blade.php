@extends ('layouts.app')

@section('title') {{__('Home')}} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center">Men are NOT all the same</h1>
        <p class="col-12 text-center">{{__('they all have unique style')}}</p>
        <p class="col-12 text-center">{{__('we are not responsible for the rest...')}}</p>
    </div>
</div>
@endsection