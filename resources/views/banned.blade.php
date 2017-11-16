<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>You are Banned.</title>
    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i|Roboto:300,400,700" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header class="header__alt">
        <div class="header__container" style="text-align: center;">
            <div class="header__logo">
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
                <div class="box box__alt box__alpha">
                    <span class="box__title">You have been banned from GameFront.com</span>
                    <div class="box__content">
                        <div class="center-block" style="text-align:center;">
                            <img src="{{ asset('images/banned.jpg') }}" alt="">
                        </div>

                        <h4>You have been banned from using GameFront.</h4>
                        <p>Think this is an error? Jump on our <a href="https://discord.gg/XUPHcaM" target="_blank">discord server</a> and talk to us in our <a href="https://discord.gg/XUPHcaM" target="_blank">#banappeals</a> channel.</p>

                        <div style="position:relative;height:0;"><iframe src="https://www.youtube.com/embed/v2AC41dglnM?rel=0&amp;controls=0&amp;showinfo=0?ecver=2&amp;autoplay=true" width="0" height="0" frameborder="0" style="position:absolute;width:100%;height:100%;left:0" allowfullscreen></iframe></div>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </section>
    </main>

    @include('layouts.footer')

    <script src="{{ asset('js/vendor.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
