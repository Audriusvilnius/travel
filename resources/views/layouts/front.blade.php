@inject('cart', 'App\Services\CartService')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/front/app.scss', 'resources/js/front/app.js'])
</head>
<body class="mystyle ">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
        <div class="container ">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    @include('front.common.hotel')
                    {{-- @include('front.common.country') --}}
                </ul>

                <!-- Right Side Of Navbar -->

                <ul class="navbar-nav ms-auto">
                    {{-- <a class="navbar-brand" href="{{ url('admin/countrys') }}">
                    {{ config('home', 'Admin') }}
                    </a> --}}
                    @if(Auth::user()?->role == 'admin')
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Data
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('hotels-index') }}">Hotel list</a>
                            <a class="dropdown-item" href="{{ route('countrys-index') }}">Offer list</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Offer
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('countrys-create') }}">Add new Offer</a>
                            <a class="dropdown-item" href="{{ route('hotels-create') }}">Add new Hotel</a>

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Orders
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('order-index') }}">Order list</a>
                        </div>
                    </li>

                    @endif
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                    <a href="{{route('cart')}}">
                        <svg class="cart">
                            <use xlink:href="#cart"></use>
                        </svg> </a>
                    @if($cart->count!=0)
                    <div class="ithem">
                        <span>{{$cart->count}}</span>
                    </div>
                </ul>
                <div class="">
                    <span>{{$cart->total}} &euro;</span>
                </div>
                @endif
            </div>
        </div>
    </nav>
    @include('layouts.head')
    <main class="py-3">
        @yield('content')
    </main>

    <footer class="py-4 footer">
        <div class="container">
            <ul class="list-group">
                <div class="container text-right ">
                    <div class=" row ">
                        <div class=" col-4">
                            <li class="list-group-item fw-light rounded page footer">
                                <p>Compamy: <span class="fw-semibold">SPA "LOST-Vacation"</span></p>
                                <p>Email: <span class="fw-semibold">email@email.com</span></p>
                                <p>Phone: <span class="fw-semibold">+370 789 12345, +370 987 88876</span></p>
                                <p>Country: <span class="fw-semibold">Antarctica (the territory South of 60 deg S)</span></p>
                                <p>City: <span class="fw-semibold">West Rafaelashire</span></p>
                            </li>
                        </div>
                        <div class=" col-4">
                            <li class="list-group-item fw-light rounded page footer">
                                <p>Compamy: <span class="fw-semibold">SPA "LOST-Vacation"</span></p>
                                <p>Email: <span class="fw-semibold">email@email.com</span></p>
                                <p>Phone: <span class="fw-semibold">+370 789 12345, +370 987 88876</span></p>
                                <p>Country: <span class="fw-semibold">Antarctica (the territory South of 60 deg S)</span></p>
                                <p>City: <span class="fw-semibold">West Rafaelashire</span></p>
                            </li>
                        </div>
                        <div class=" col-4">
                            <li class="list-group-item fw-light rounded page footer">
                                <p>Compamy: <span class="fw-semibold">SPA "LOST-Vacation"</span></p>
                                <p>Email: <span class="fw-semibold">email@email.com</span></p>
                                <p>Phone: <span class="fw-semibold">+370 789 23456, +370 987 88776</span></p>
                                <p>Country: <span class="fw-semibold">South Africa</span></p>
                                <p>City: <span class="fw-semibold">Koeppmouth</span></p>
                            </li>
                        </div>
                    </div>
                </div>
            </ul>
            <div class="py-0 footer">
                <hr class=" border border-second border-1 opacity-50">
                <p class="text-center">LOST-Vacation © 2023</p>
            </div>
        </div>
    </footer>
    @include('layouts.svg')
</body>
</html>
