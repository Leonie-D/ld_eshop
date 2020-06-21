<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MaNats')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        Men are NOT all the same
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            @if ($cartTotalQuantity > 0)
                                <a href='{{route('panier.index')}}'>Panier ({{$cartTotalQuantity}})</a>
                            @endif
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Site navigation -->
                            <li class="mr-2">
                                <a class="btn btn-secondary" href="{{ route('product.index') }}">
                                    {{ __('New collection') }}
                                </a>
                            </li>
                            <li class="dropdown show">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Categories') }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">
                                    <a class="dropdown-item" href=" {{ route('category.index') }}"> 
                                        {{ __('All the categories') }}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    @foreach($mCategories as $mCategory)
                                        <a class="dropdown-item" href=" {{ route('category.show', ['category' => $mCategory]) }}"> 
                                            {{ __($mCategory->name) }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>

                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                        <a class="dropdown-item" href={{ route('user.edit', ['user' => auth()->user()]) }}>
                                            {{__('Edit profil')}}
                                        </a>
                                    </div>
                                </li>
                            @endguest

                            <!-- Location Links -->
                            @if(app()->getLocale() === 'en')
                                <li>
                                    <a class="btn btn-secondary" href="{{ route('lang', ['lang' => 'fr']) }}">Fr</a>
                                </li>
                            @elseif(app()->getLocale() === 'fr')
                                <li>
                                    <a class="btn btn-secondary" href="{{ route('lang', ['lang' => 'en']) }}">En</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-4 flex-grow-1" style="position: relative;">
            @yield('content')

            @if(Session::has('message'))
                @include('includes.toast')
            @endif
        </main>

        <footer>

        </footer>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @if(Session::has('message'))
        <script>
            $(document).ready(function(){
                $('.toast').toast('show');
            });
        </script>
    @endif

    @yield('script')

</body>
</html>
