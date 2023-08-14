<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PACT') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Styles -->

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<header>
    <div class="header-wrapper {{ request()->is('/') ? ' d-none' : '' }}">
        <div class="header-content">
            <div class="user-manage">
            <div class="user-icon">
            <div class="nav-item dropdown">
    @auth <!-- Check if a user is authenticated -->
        <a id="navbarDropdown" class="nav-link dropdown-toggle list-item-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="22" cy="22" r="21.5" fill="#D9D9D9" stroke="black"/>
                <circle cx="22" cy="15" r="6" fill="#9D9D9D"/>
                <ellipse cx="22" cy="33" rx="14" ry="8" fill="#9D9D9D"/>
            </svg>
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <a class="dropdown-item" href="/users/profile" >
                {{ __('Edit Profile') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    @endauth
</div>
    
      
</div>
               
            </div>
        </div>
    </div>
</header>
<!-- body-content -->
    <div id="app" class="main-wrapper">
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm main-nav-wrapper">
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'PACT') }}
                </a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="main-nav navbar-nav ms-auto {{ request()->is('/') ? ' d-none' : '' }}">
                   
                               
                        <!-- Authentication Links -->
                        @guest
                            <!-- @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                        @if (Auth::user()->usertype == 1)

                        <li class="nav-item dropdown ">
                                <a  class="nav-link list-item-link {{ request()->is('users*') ? 'active' : '' }}" href="/users" >
                                    {{'Users' }}
                                </a>

                          
                                
                            </li>
    @endif

                            @if (Auth::user()->usertype == 1)

                            <li class="nav-item ">
                                <a  class="nav-link  list-item-link {{ request()->is('companies*') ? 'active' : '' }}" href="/companies">
                                    {{'Company' }}
                                </a>

                                
                                
                            </li>
    @endif

                            @if (Auth::user()->usertype == 1)

                            <li class="nav-item ">
                                <a class="nav-link  list-item-link {{ request()->is('locations*') ? 'active' : '' }}" href="/locations">
                                    {{'Location' }}
                                </a>

                               
                            </li>
    @endif

                            @if (Auth::user()->usertype == 1)

                            <li class="nav-item  ">
                                <a  class="nav-link list-item-link {{ request()->is('states*') ? 'active' : '' }}" href="/states">
                                    {{'State' }}
                                </a>

                                
                            </li>
    @endif

    @if (Auth::user()->usertype == 1 || Auth::user()->usertype == 2)
        <li class="nav-item ">
            <a  class="nav-link  list-item-link {{ request()->is('projects*') ? 'active' : '' }}" href="/projects" >
                {{ 'Projects' }}
            </a>
        </li>
    @endif
                            <li class="nav-item ">
                                <a  class="nav-link  list-item-link {{ request()->is('purchasecategories*') ? 'active' : '' }}" href="/purchasecategories" >
                                    {{'Purchase Category' }}
                                </a>

                             
                                
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link  list-item-link {{ request()->is('purchases*') ? 'active' : '' }}" href="/purchases" >
                                    {{'Purchase' }}
                                </a>
                              
                                
                            </li>
                                 <!-- <li class="nav-item dropdown ">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle list-item-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" href="/users/profile" >
                                        {{ __('Edit Profile') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li> -->
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-body">
            @yield('content')
        </main>
    </div>
    
</body>
</html> 
<script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker();
        });

      // Get all the navigation links
    // const navLinks = document.querySelectorAll('.list-item-link');

    // // Add a click event listener to each navigation link
    // navLinks.forEach(navLink => {
    //     navLink.addEventListener('click', function(event) {
    //         // Prevent the default behavior of the anchor link
    //         // event.preventDefault();

    //         // Remove the 'active' class from all navigation links
    //         navLinks.forEach(link => {
    //             link.classList.remove('active');
    //         });

    //         // Add the 'active' class to the clicked navigation link
    //         this.classList.add('active');
    //     });
    // });

    </script>