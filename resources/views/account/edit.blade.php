@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render() }}
@endsection

@section('content')
<main class="site">
    <section class="site__container">
        <div class="col-3">
            @include('account.partials.sidebar')
        </div>
        <div class="col-9">
            <div class="box box--with-margin">
                <span class="box__title">Edit Your Account</span>
                <div class="box__content">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (auth()->user()->isAdmin())
                        <div class="alert alert-info">
                            <strong class="u-text-center">
                                Administrators must use OPS to change their password
                            </strong>
                        </div>
                        <a href="{{ route('adminResetPassword') }}" class="button">
                            Change My Password on OPS
                        </a>
                    @else
                    <form action="{{ route('profileUpdate') }}" method="POST" class="form">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form__group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form__input" name="email" id="email">
                        </div>

                        <div class="form__group">
                            <label for="password">Old Password</label>
                            <input type="password" class="form__input" name="password" id="password">
                        </div>

                        <div class="form__group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form__input" name="new_password" id="new_password">
                        </div>

                        <div class="form__group">
                            <label for="new_password_confirmation">New Password Confirmation</label>
                            <input type="password" class="form__input" name="new_password_confirmation" id="new_password_confirmation">
                        </div>

                        <input type="submit" value="Save Profile">

                    </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@push("scripts-after")
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
@endpush
