<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEO::generate() !!}

    <link href="https://fonts.googleapis.com/css?family=Crete+Round:400,400i|Roboto:300,400,700" rel="stylesheet">

    <!-- Styles -->
    @stack('styles-before')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles-after')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        window.App = {!!
            json_encode([
                'homeUrl' => route('index'),
                'signedIn' => auth()->check(),
                'user'     => auth()->user()
            ]);
        !!}
    </script>
</head>
<body>
    <div id="app">
        <header class="header__alt">
            <div class="header__container">
                <div class="header__logo">
                    <a href="/">
                        {{-- <img src="{{ asset('images/logo.svg') }}" alt=""> --}}
                        <h1>Website Logo</h1>
                    </a>
                </div>
                <div class="ad" style="float:right;display:inline-block;vertical-align: middle;padding:1rem 0;">
                    <!-- #partials.sponsor -->
                    <h1>Ad Slot</h1>
                    <!-- / #partials.sponsor -->
                </div>
            </div>
        </header>

        <header class="header__menu">
            <div class="menu__container">
                <nav class="header__navigation">
                    <ul class="menu">
                        <li class="menu__item @if (Route::current()->getName() == 'index') menu__item--active @endif">
                            <a href="/" class="menu__link">Home</a>
                        </li>


                        <li class="menu__item @if (in_array(Route::current()->getName(), ['articles', 'articleShowCategory', 'showArticle'])) menu__item--active @endif">
                            <a href="{{ route('articles') }}" class="menu__link">News</a>
                        </li>

                        <li class="menu__item @if (in_array(Route::current()->getName(), ['forumIndex', 'forumDisplay', 'showThread', 'memberList'])) menu__item--has-children-active menu__item--active @else menu__item--has-children @endif">
                            <a href="{{ route('forumIndex') }}" class="menu__link">Community</a>
                            <ul class="menu">
                                <li class="menu__item">
                                    <a href="{{ route('forumIndex') }}" class="menu__link">Forums</a>
                                    <a href="{{ route('memberList') }}" class="menu__link">User Directory</a>
                                    <a href="{{ route('forumIndex') }}" class="menu__link">Contact Us</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="menu__right">
                        @if (Auth::check())


                            <li class="menu__item menu__item--has-children @if (in_array(Route::current()->getName(), ['me', 'myAccount', 'accountEdit'])) menu__item--has-children-active menu__item--active @else menu__item--has-children @endif">
                                <a href="{{ route('me', auth()->user()->profile->slug) }}" class="menu__link">
                                    <img src="{{ auth()->user()->profile->avatar }}" class="nav-avatar" />  {{ auth()->user()->name }}
                                </a>
                                <ul class="menu">
                                    <li class="menu__item">
                                        <a href="{{ route('myAccount') }}" class="menu__link">
                                            Control Panel
                                        </a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="{{ route('messageIndex') }}" class="menu__link">
                                            Conversations
                                        </a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="{{ route('me', auth()->user()->profile->slug) }}" class="menu__link">
                                            Your Profile
                                        </a>
                                    </li>

                                    @if (auth()->user()->isStaff())
                                        <li class="menu__item">
                                            <a href="{{ route('ops') }}" class="menu__link">
                                                OPS Admin Panel
                                            </a>
                                        </li>
                                    @endif

                                    <li class="menu__item">
                                        <a href="{{route('logout')}}" class="menu__link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="menu__item">
                                <a href="#" class="menu__link"><i class="fa fa-bell" style="color: #fff;"></i></a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @else
                            <li class="menu__item">
                                <a href="{{ route('login') }}" class="menu__link">Login / Sign Up</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </header>
        @yield('breadcrumbs')

        @yield('content')
    </div>

    @include('layouts.footer')

    <!-- Scripts -->
    @stack('scripts-before')
    <script src="{{ asset('js/vendor.js?v=2.0.1') }}"></script>
    <script src="{{ asset('js/editor.js?v=2.0.1') }}"></script>

    {{-- <script src="{{asset('js/ckeditor/ckeditor.js?v=2.0.1')}}"></script> --}}
    {{-- <script src="{{asset('js/ckeditor/adapters/jquery.js?v=2.0.1')}}"></script> --}}
    
    <script src="{{ asset('js/app.js?v=2.0.1') }}"></script>
    @stack('scripts-after')

    @include('sweet::alert')
</body>
</html>
