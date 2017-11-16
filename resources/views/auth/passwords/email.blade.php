@extends('layouts.master')

@section('content')
<section class="site__container">
    <div class="col-12">
        <div class="box">
            <span class="box__title">Reset Password</span>
            <div class="box__content">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form__input" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                    <button type="submit" class="btn btn-primary">
                        Send Password Reset Link
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
