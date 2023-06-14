<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<title>FSJES : Confirmation de présence</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/adminLTE/plugins/jquery/jquery.min.js">
    </script>    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"> --}}
  <link href="https://fonts.googleapis.com/css2?family=Petrona&display=swap" rel="stylesheet">


  <!-- Styles -->
  <style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        /* font-family: 'Nunito', sans-serif; */
        font-family: 'Petrona', serif;

        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
        color: rgb(22, 96, 233);
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
 

  <!-- Not required: presentational-only.css only contains CSS for prettifying the demo -->
  {{-- <link rel="stylesheet" href="presentational-only/presentational-only.css"> --}}

  <!-- responsive-full-background-image.css stylesheet contains the code you want -->
   <link rel="stylesheet" href="page/responsive-full-background-image.css"> 
  
  {{-- <!-- Not required: jquery.min.js and presentational-only.js is only used to demonstrate scrolling behavior of the viewport  -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="presentational-only/presentational-only.js"></script> --}}
</head>
<body>
    <div class="flex-center position-ref full-height">
        {{-- @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif --}}

        <div class="content">
            <img src="/img/Image1.png" alt="FSJES TETOUAN Logo" class="img" style="width: 150px; height:150px;">
            <div id="titre"  class="title m-b-md">
                FSJES 
                <p  class="text-center " style="font-size: 50px;text-shadow: 3px 3px 2px #bceaf5;">Espace de Confirmation de présence</p>
            </div>

            <div class="links">
                
                @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
            <div class="register">
               <button class="btn btn-success btn-lg"> <a class="text-white" href="{{ route('login') }}">Se connecter</a></button>

                @if (Route::has('register'))
                <button class="btn btn-primary btn-lg">   <a class="text-white" href="{{ route('register') }}">S'inscrire</a></button>
                @endif
            </div>
            @endauth
            </div>
        </div>
    </div>
</body>

<script >
$('.img').hide();
$('#titre').hide();
$('.register').hide();
 $(function(){
    
     $('#titre').fadeIn().css({bottom:0,left:0,right:0,position:'absolute'}).animate({bottom:400}, 800, function() {
    //callback
    });
   
    $('.register').fadeIn().css({top:0,left:0,right:0,position:'absolute'}).animate({top:500}, 800, function() {
    //callback
    });
    
    $('.img').fadeIn().css({bottom:1000,left:560,position:'absolute'}).animate({bottom:700}, 800, function() {
        $('.img').fadeTo(3000,0.6,function(){
            $('.img').fadeTo(1,1);
        });
    });



 });
 
</script>
</html>



{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html> --}}
