<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/citymarket.ico')}}">

    <!-- NONE CACHE -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CityPoster') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Styles & script-->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/select2.min.js') }}" defer></script>

     <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-custom">
            <div class="container">

                <div class="logo">
                    <a href="{{ url('/') }}" class="navbar-brand text-logo"><img src="{{asset('img/cityplus2.png')}}" class="logo-img"></a>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav mr-auto">
                            @if(Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-upload"></i>Importar</a>
                                </li>

                            @endif

                            @if(Auth::user()->isAdmin())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('offers') }}"><i class="fa fa-table"></i>Ofertas de la Semana</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-table"></i>Ofertas de la Semana</a>
                                </li>
                            @endif
                        </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                           <!--  <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li> -->
                            @if (Route::has('register'))
                               <!--  <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li> -->
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user-circle-o"></i>
                                    {{ Auth::user()->user }} <span class="caret"></span>
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
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-container">
        <div id="app">
            @yield('content')
        </div>
    </main>

    <footer class="footer"> 
         Copyright © 2014-{{ Date('Y') }} | PRV STORES PY SA | All Rights Reserved.
    </footer>

    <!-- Scripts -->
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>

     <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

    <script> 
        $( document ).ready(function() {
          $( "#add-image-btn" ).click(function() {
               $("#image-form").submit();
          });


          $(".notification").delay(5000).slideUp(300);


            function RunSelect2(){
              $('#sites').select2({
                 placeholder : "Selecciona una o mas tiendas",
                 allowClear: true,
                 closeOnSelect: false,
                 allowClear: true,
                 tags: true 
              }).on('select2:open', function() {  

                setTimeout(function() {
                    $(".select2-results__option .select2-results__group").bind( "click", selectAlllickHandler ); 
                }, 0);

              });
            }

            RunSelect2();


            var selectAlllickHandler = function() {
                $(".select2-results__option .select2-results__group").unbind( "click", selectAlllickHandler );        

                $('#sites').select2('destroy').find('option').prop('selected', 'selected').end();
              RunSelect2();
                $(".select2-selection.select2-selection--multiple").css({"height": "60px", "overflow": "auto"});
            };  

        });//fin


    </script>
</body>
</html>


            