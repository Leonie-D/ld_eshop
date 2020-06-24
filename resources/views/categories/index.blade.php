@extends('layouts.app')

@section('title') {{__('All the categories')}} @endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-12 text-center mb-5">MaNats - {{__('All the categories')}}</h1>
        <ul class="list-unstyled">
            @foreach($categories as $category)
                <li class="mb-3">
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
