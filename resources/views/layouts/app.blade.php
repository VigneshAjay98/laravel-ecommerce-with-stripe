<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('public/mdbootstrap4/js/vendor/jquery-1.12.0.min.js') }}"></script>
    <script src="{{ secure_asset('public/mdbootstrap4/js/popper.min.js') }}"></script>
    <script src="{{ secure_asset('public/mdbootstrap4/js/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('public/mdbootstrap4/js/mdb.min.js') }}"></script>
    <script src="{{ secure_asset('public/fontawesome-5.13.0/js/all.js') }}"></script>
    @yield('scripts')
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ secure_asset('public/fontawesome-5.13.0/css/all.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ secure_asset('public/mdbootstrap4/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('public/mdbootstrap4/css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('public/mdbootstrap4/css/style.css') }}" rel="stylesheet">

</head>

<body>
<div id="app">
  <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm" >
      <div class="container">
          <a class="navbar-brand" href="{{ route('home') }}">
              @yield('title')
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Authentication Links -->
          @if(Auth::check())
              <!-- Right Side Of Navbar -->
              <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('Cart') }}"><img src="{{ secure_asset('shopping-cart.png') }}"  alt="cart logo"  width="20" height="20"><span class="badge badge-pill badge-primary">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
                          </a>
                      </li>
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ Auth::user()->name }} <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                              <a class="dropdown-item" href="{{ route('profile') }}">My orders</a>
                          </div>
                      </li>
                  @else
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                              <a class="nav-link" href="{{ route('login') }}">Login</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">Register</a>
                      </li>
                    </ul>
                  @endif
              </ul>
        </div>
      </div>
  </nav>

  <main class="py-4">
        @yield('content')
  </main>
        @yield('footer')
</body>
</html>


  