@extends('layouts.master')

@section('content')
<main id="app">
    <section class="gamefront__container">
        @if (env('FILESNATION_BETA') == 1) 
            <div class="alert alert-success">
                <p><strong>😅 We're in beta!</strong></p>
                <br>
                <p>We've moved the FilesNation.com forums over to our new platform. <a href="{{route('login')}}">Please log in with your FilesNation Account!</a></p>
                <br>
                <p>Please read the topic in our announcements forum for more information!</p>
            </div>
        @endif
        <div class="col-12">
            <div class="box">
                <span class="box__title">Welcome to GameFront</span>
                <div class="box__content">
                    <h3>Hello you!</h3>
                    <p>GameFront is currently in Beta. Please enter your invite code to create an account and gain access.</p>
                </div>
            </div>
        </div>
        
        <div class="col-6">
            <div class="box">
                <span class="box__title">What's the magic word?</span>
                <div class="box__content">
                    <form action="{{ route('checkInvite') }}" class="form" method="get">
                        <input type="email" class="form__input" id="email" name="email" placeholder="Your email address" value="{{request()->email}}">
                        <input type="text" class="form__input" id="invite_code" name="invite_code" placeholder="Please enter your invitation code." value="{{request()->invite_code}}">
                        <button type="submit" class="button">Let me in</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-6">
            <div class="box box--with-margin">
                <span class="box__title">Already a Member?</span>
                <div class="box__content">
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
            </div>
        </div>
    </section>
</main>
@endsection
