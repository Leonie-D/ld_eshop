@extends('layouts.app')

@section('title') {{__('All the categories')}} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center">MaNats - {{__('All the categories')}}</h1>
        <ul class="row list-unstyled">
            @foreach($categories as $category)
                <li class="col-4 mb-4">
                    <h3> 
                        <a href="{{ route('category.show', ['category' => $category]) }}">
                            {{ __($category->name) }} 
                            {{-- image --}}
                        </a>
                    </h3>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection