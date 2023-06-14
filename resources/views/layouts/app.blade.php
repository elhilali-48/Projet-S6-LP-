<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FSJES : Confirmation</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script> --}}
    <script src="/adminLTE/plugins/jquery/jquery.min.js">
    </script> 

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    @yield('stylesheets')
</head>
<body>
    
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img src="/img/Image1.png" alt="FSJES TETOUAN Logo" class="rounded float-left " style="opacity: .8; width:50px;height:60px">
                <div class="navbar-brand"><b> &nbsp; FSJES TETOUAN</b></div>
                {{-- <a class="navbar-brand" href="{{ url('/home') }}">
                    FSJES TETOUANE 
                </a> --}}
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
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @auth
        
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-4 py-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{ route('users.edit', auth()->user()->id)}}">Profile</a> 
                            </li>
                        <li class="list-group-item">
                        <a href="{{ route('post.index')}}">Posts</a> 
                        </li>
                        <li class="list-group-item">
                           <a href="{{ route('category.index')}}">Categories</a> 
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('trashed.index')}}">Post Supprimer</a> 
                         </li>
                         <li class="list-group-item">
                            <a href="{{ route('tag.index')}}">Tags</a> 
                         </li>
                         @if (auth()->user()->isAdmin())
                         <li class="list-group-item">
                            <a href="{{ route('users.index')}}">Users</a> 
                         </li>

                         @endif

                    </ul>
                </div> --}}
      
              
                <div class="col-md-8 ">
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div> 
                
            </div>
        </div>
        @else
        <main class="py-4">
            @yield('content')
        </main>
        @endauth
        

  
    </div>
    @yield('sripts')
    <script>
$("nav").hover(function(){
  $("nav").css("background-color", "yellow");
});

        </script>
</body>
</html>
