<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('/js/404/jquery-1.4.1.min.js')}}"></script>
    <script src="{{ asset('/js/404/vector_battle_regular.typeface.js')}}"></script>
    <script src="{{ asset('/js/404/ipad.js')}}"></script>
    <script src="{{ asset('/js/404/game.js')}}"></script>
    <style>
        #canvas { border:0px solid black; top:0px; left:0px; }
    </style>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>404 - Page Not Found - GameFront</title>
    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i|Roboto:300,400,700" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header class="header__alt">
    <div class="header__container" style="text-align: center;">
        <div class="header__logo" style="padding: 10px;">
            <a href="/">
                <img src="{{ asset('images/logo.svg') }}" alt="">
            </a>
        </div>
    </div>
</header>

<main id="app">
    <section class="gamefront__container">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="box box--with-margin" style="padding: 0px; min-width: 680px; background-image: url({{ asset('/js/404/404-error.jpg')}}); background-size: cover;">
                <span class="box__title" style="margin-left: 10px; margin-right: 10px;">
                    <i class="fa fa-exclamation-triangle"></i> Sorry, we couldn't find that one!
                </span>
                <canvas id="canvas" width="680px" height="540"></canvas>
            </div>
        </div>
        <div class="col-3"></div>
    </section>
</main>

@include('layouts.footer')

</body>
</html>



