<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- font-awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
</head>
<body class="{{(Route::current()->getName() != 'welcome') ? 'grey' : ''}}">
    <div id="app">
        <div id="mobile-nav-toggle" @click="mobileNav=!mobileNav">
            <i v-show="!mobileNav" class="fas fa-align-left"></i>
            <i v-show="mobileNav" class="fas fa-times"></i>
        </div>
        <transition name="custom-classes-transition"
            enter-active-class="animated fadeInLeft"
            leave-active-class="animated fadeOutLeft">
            <div class="mobile-navbar" v-show="mobileNav">
                <ul>
                    <li class="username">{{auth()->user()->name}}</li>
                    <li class='{{(Route::currentRouteName()=="nearbyShops")? "active":""}}'><a href="{{route('nearbyShops')}}">nearby shops</a></li>
                    <li class='{{(Route::currentRouteName()=="preferredShops")? "active":""}}'><a href="{{route('preferredShops')}}">my preferred shops</a></li>
                    <li><a class="logout-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a></li>
                </ul>
                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </transition>
        <div class="navbar">
            <ul>
                <li class="username">{{auth()->user()->name}}</li>
                <li class='{{(Route::currentRouteName()=="nearbyShops")? "active":""}}'><a href="{{route('nearbyShops')}}">nearby shops</a></li>
                <li class='{{(Route::currentRouteName()=="preferredShops")? "active":""}}'><a href="{{route('preferredShops')}}">my preferred shops</a></li>
                <li><a class="logout-button" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Logout</a></li>
            </ul>
            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
