@extends('layouts.master')

@section('content')
<section class="site__container">
    <div class="col-3"><!-- Spacer --></div>

    <div class="col-6">
        <div class="box box--with-margin">
            <span class="box__title">Register New Account</span>
            <div class="box__content">
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <label for="name">Username</label>
                    <input id="name" type="text" class="form__input" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif

                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form__input" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                    <label for="password">Password</label>
                    <input id="password" type="password" class="form__input" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form__input" name="password_confirmation" required>

                    @captcha()

                    <button type="submit" class="button blue">
                        Register Account
                    </button>


                </form>
            </div>
        </div>
    </div>

    <div class="col-3"><!-- Spacer --></div>
</section>
@endsection
