<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>
        @yield('title') | {{ config('app.name' ) }}
    </title>


    <!-- Font Awesome -->
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">

    @stack('styles')

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="white-skin">
    <div id="app">

        <!-- Navbar -->
        <nav class="fixed-top navbar navbar-expand-lg navbar-dark primary-color">
            <div class="container">

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <strong> {{ config('app.name', 'Laravel') }}</strong>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Collapsible content -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Prihlásenie</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">Registrácia</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                            @if ( Auth::user()->avatar )
                                                <img src=" {{ Auth::user()->avatar('small') }}" class="navbar-avatar">
                                            @else
                                                <i class="fas fa-user"></i>
                                            @endif

                                            {{ Auth::user()->name }} <span class="caret"></span>

                                    </a>

                                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('product.create') }}">
                                            Pridať inzerát
                                        </a>
                                        <a class="dropdown-item" href="{{ route('user.profile', ['id' => Auth::id()]) }}">
                                            Môj profil
                                        </a>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Odhlásiť
                                        </a>

                                        <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                    </div>
                                </li>
                            @endguest
                            <!-- Authentication Links -->

                        </ul>
                        <!-- Right Side Of Navbar -->

                    </div>
                    <!-- Collapsible content -->

            </div>
        </nav>
        <!-- Navbar -->

        <div style="height: 56px" class="w-0"></div>

        <main>

            @yield('content')

        </main>

    </div>

    <!-- <script type="text/javascript" src="{{ asset('js/app.js') }}"></script> -->

        <!-- JQuery -->
      <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
      <!-- Bootstrap tooltips -->
      <!-- <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>  -->
      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
      <!-- MDB core JavaScript -->
      <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>

      <script>

        $(document).ready(function() {
            $('.mdb-select').materialSelect();
        });


        $(function () {
            $("#mdb-lightbox-ui").load("/mdb-lightbox-ui.html");
        });

      </script>

    @stack('scripts')

</body>
</html>
