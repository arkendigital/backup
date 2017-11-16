@extends('layouts.master')

@section('content')
<div class="site__container">
    <div class="col-12">
        <div class="box">
            <span class="box__title">Reset Password</span>
            <div class="box__content">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">

                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form__input" name="email" value="{{ $email or old('email') }}" required autofocus>

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

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif

                    <button type="submit">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
