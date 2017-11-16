@extends('layouts.master')

@section('content')

<section class="forums">
    <div class="site__container">
        <div class="col-3"><!-- Spacer --></div>

        <div class="box col-6 box__login u-text-center box--with-margin">
            <span class="box__title">Sign-in with Social</span>
            <div class="social-auth">
                <!-- Socialauth Facebook -->
                <a class="resp-social-button__link" href="{{ route('socialAuth', 'facebook') }}" aria-label="Sign in with Facebook Account">
                    <div class="resp-social-button resp-social-button--facebook resp-social-button--large">
                        <div aria-hidden="true" class="resp-social-button__icon resp-social-button__icon--solid">
                            <i class="fa fa-facebook-official" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>

                <!-- Socialauth Google -->
                <a class="resp-social-button__link" href="{{ route('socialAuth', 'google') }}" aria-label="Sign in with Google Account">
                    <div class="resp-social-button resp-social-button--google resp-social-button--large">
                        <div aria-hidden="true" class="resp-social-button__icon resp-social-button__icon--solid">
                            <i class="fa fa-google" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>

                <!-- Socialauth Twitter -->
                <a class="resp-social-button__link" href="{{ route('socialAuth', 'twitter') }}" aria-label="Sign in with Twitter Account">
                    <div class="resp-social-button resp-social-button--twitter resp-social-button--large">
                        <div aria-hidden="true" class="resp-social-button__icon resp-social-button__icon--solid">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>

                <!-- Socialauth Steam -->
                <a class="resp-social-button__link" href="{{ route('socialAuth', 'steam') }}" aria-label="Sign in with Steam Account">
                    <div class="resp-social-button resp-social-button--steam resp-social-button--large">
                        <div aria-hidden="true" class="resp-social-button__icon resp-social-button__icon--solid">
                            <i class="fa fa-steam" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>

                <!-- Socialauth Microsoft -->
                <a class="resp-social-button__link" href="{{ route('socialAuth', 'live') }}" aria-label="Sign in with Microsoft Account">
                    <div class="resp-social-button resp-social-button--microsoft resp-social-button--large">
                        <div aria-hidden="true" class="resp-social-button__icon resp-social-button__icon--solid">
                            <i class="fa fa-windows" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>

                <!-- Socialauth Twitch -->
                <a class="resp-social-button__link" href="{{ route('socialAuth', 'twitch') }}" aria-label="Sign in with Twitch Account">
                    <div class="resp-social-button resp-social-button--twitch resp-social-button--large">
                        <div aria-hidden="true" class="resp-social-button__icon resp-social-button__icon--solid">
                            <i class="fa fa-twitch" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>

                <!-- Socialauth Discord -->
                <a class="resp-social-button__link" href="{{ route('socialAuth', 'discord') }}" aria-label="Sign in with Discord Account">
                    <div class="resp-social-button resp-social-button--discord resp-social-button--large">
                        <div aria-hidden="true" class="resp-social-button__icon resp-social-button__icon--solid">
                            <i class="fa fa-plug" aria-hidden="true"></i>
                        </div>
                    </div>
                </a>
            </div>
            <span class="box__title">GameFront Account</span>

            <form class="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <label for="email" class="col-4 control-label">E-Mail Address</label>
                <input id="email" type="email" class="form__input" name="email" value="{{ old('email') }}" required autofocus>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <label for="password" class="col-4 control-label">Password</label>
                <input id="password" type="password" class="form__input" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif

                <div class="form-group">
                    <div class="col-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-12 u-center">
                    <button type="submit" class="button">
                        Login
                    </button>

                    <a class="button blue" href="{{ route('password.request') }}">
                        Forgot Your Password?
                    </a>

                    <a class="button blue" href="{{ route('register') }}">
                    	Need an Account?
                    </a>
                </div>
            </form>
        </div>

        <div class="col-3"><!-- Spacer --></div>
    </div>
</section>

@endsection
