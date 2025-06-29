 <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Vente & Location Voitures')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <a class="navbar-brand" href="{{ route('cars.index') }}">Vente & Location Voitures</a>
  
  <div class="ml-auto d-flex align-items-center">
    <a href="{{ route('cars.index') }}" class="btn btn-outline-primary mx-1">Toutes les voitures</a>

    @auth
      @if(auth()->user()->is_admin)
        <a href="{{ route('admin.cars.create') }}" class="btn btn-primary mx-1">Ajouter une voiture</a>
      @endif

      {{-- Menu “Mon Espace” --}}
      <div class="dropdown mx-1">
        <button class="btn btn-secondary dropdown-toggle" 
                type="button" id="accountMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mon Espace
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountMenu">
          @if(auth()->user()->is_admin)
            <a class="dropdown-item" href="{{ route('admin.cars.index') }}">Dashboard Admin</a>
            <!-- <a class="dropdown-item" href="{{ route('admin.cars.index') }}">Gestion bookings</a> -->
          @else
            <a class="dropdown-item" href="{{ route('user.bookings.index') }}">Mes réservations</a>
            <a class="dropdown-item" href="{{ route('user.bookings.create') }}">Réserver une voiture</a>
            <a class="dropdown-item" href="{{ route('user.purchases.index') }}">Mes achats</a>
          @endif
          <div class="dropdown-divider"></div>
          <form action="{{ route('logout') }}" method="POST" class="px-4 py-2 m-0">
            @csrf
            <button type="submit" class="btn btn-link p-0">Déconnexion</button>
          </form>
        </div>
      </div>
    @endauth

    @guest
      <a href="{{ route('login') }}" class="btn btn-link mx-1">Connexion</a>
      <a href="{{ route('register') }}" class="btn btn-link mx-1">Créer un compte</a>
    @endguest
  </div>
</nav>
            <div class="container">
               <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Vente & Location Voitures') }}
                </a>
-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
