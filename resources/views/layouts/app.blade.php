<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="{{route('properties.index')}}" class="nav-link">@lang('menu.properties')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tenants.index')}}" class="nav-link">@lang('menu.tenants')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('tenancies.index')}}" class="nav-link">@lang('menu.tenancies')</a>
                    </li>
                </ul>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('images/logo.png')}}" alt="">
                </a>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">@lang('menu.login')</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">@lang('menu.register')</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ auth()->user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/home') }}">@lang('menu.home')</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    @lang('menu.logout')
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">@lang('menu.language')</a>
                        <div class="dropdown-menu" aria-labelledby="languageDropdown">
                            <a href="{{ url('locale/en') }}" class="dropdown-item">
                                <img src="{{ asset('lang-icons/en.png') }}" alt="english">
                                @lang('menu.english')

                            </a>
                            <a href="{{ url('locale/ru') }}" class="dropdown-item">
                                <img src="{{ asset('lang-icons/ru.png') }}" alt="russian">
                                @lang('menu.russian')
                            </a>
                        </div>
                    </li>
                    <form action="/search" method="GET">
                        @csrf
                        <div class="dropdown">
                            <div class="dropdown-content">
                                <input type="text" name="search" id="search" class="form-control"
                                       placeholder="Search ...">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <div class="content"></div>
                            </div>
                        </div>
                    </form>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="information">
                            <h3 class="title">Information</h3>
                            <ul>
                                <li>
                                    <i class="fas fa-phone"></i>
                                    <span>+1 212-758-8877</span>
                                </li>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>1 E 57th St, New York</span>
                                </li>
                                <li>
                                    <i class="fas fa-clock"></i>
                                    <span>10AM - 9PM</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="features">
                            <h3 class="title">Features</h3>
                            <ul>
                                <li>
                                    <a href="{{route('properties.index')}}">Properties</a>
                                </li>
                                <li>
                                    <a href="{{route('tenants.index')}}">Tenants</a>
                                </li>
                                <li>
                                    <a href="{{route('tenancies.index')}}">Tenancies</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="social-pages">
                            <h3 class="title">Social Pages</h3>
                            <ul>
                                <li><i class="fab fa-facebook-f"></i></li>
                                <li><i class="fab fa-instagram"></i></li>
                                <li><i class="fab fa-twitter"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
    $(document).ready(function () {
        $('#search').keyup(function () {

            $('.content').empty();

            if (this.value.length >= 3) {
                $.ajax({
                    type: 'GET',
                    url: '/search',
                    data: {
                        search: $('#search').val(),
                    },
                    success: function (result) {
                        for (let index = 0; index < result.data.length; index++) {
                            $('.content').append("<a>" + result.data[index]['name_en'] + "</a>");
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        })
    })
</script>

</body>
</html>
