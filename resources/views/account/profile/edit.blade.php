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
            <div class="box box box--with-margin">
                <span class="box__title">Customize Profile</span>
                <div class="box__content">
                    <avatar-form :user="{{ auth()->user() }}"></avatar-form>
                </div>
            </div>

            <hr>

        <form action="{{ route('profileUpdate') }}" method="POST" class="form">
            <div class="box box box--with-margin">
                <span class="box__title">Edit Profile Information</span>
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

                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form__group">
                        <label for="display_name">Display Name</label>
                        <input type="text" class="form__input" name="display_name" id="display_name"  placeholder="Display Name" value="{{ auth()->user()->profile->display_name }}">
                    </div>

                    <div class="form__group">
                        <label for="user_title">User Title</label>
                        <input type="text" maxlength="191" class="form__input" name="user_title" id="user_title"  placeholder="User Title" value="{{ auth()->user()->profile->user_title ?? null }}">
                    </div>

                    <div class="form__group">
                        <label for="about">About</label>
                        <textarea name="about" id="about" class="form__input js-editor">{{ auth()->user()->profile->about ?? null }}</textarea>
                    </div>

                    <div class="form__group">
                        <label for="signature">Signature</label>
                        <textarea name="signature" id="signature" class="form__input js-editor">{{ auth()->user()->profile->signature ?? old('signature') }}</textarea>
                    </div>

                    <div class="form__group">
                        <label for="location">Location</label>
                        <input type="text" class="form__input" name="location" id="location"  placeholder="Location" value="{{ auth()->user()->profile->location ?? null }}">
                    </div>

                    <div class="form__group">
                        <label for="gender">Gender</label>
                        <input type="text" class="form__input" name="gender" id="gender" placeholder="Gender" value="{{ auth()->user()->profile->gender ?? null }}">
                    </div>

                    <div class="form__group">
                        <label for="date_birth">Date of Birth</label>
                        @if (auth()->user()->profile->date_birth)
                        <input type="text" class="form__input" name="date_birth" id="date_birth" placeholder="Date of Birth" value="{{ auth()->user()->profile->date_birth->format('F jS Y') }}">
                        <small>mm/dd/yyyy (or type out your date of birth, ie 1st January 1970)</small>
                        @else
                        <input type="text" class="form__input" name="date_birth" id="date_birth" placeholder="Date of Birth" value="{{ auth()->user()->profile->date_birth }}">
                        <small>mm/dd/yyyy (or type out your date of birth, ie 1st January 1970)</small>
                        @endif
                    </div>
                </div>
                <input type="submit" value="Save Profile" class="button">
            </div>
            <br>
            <div class="box box box--with-margin">
                <span class="box__title">Edit Contact Information</span>
                <div class="box__content">
                    <div class="form__group">
                        <label for="social_networks[twitter]">Twitter</label>
                        <input type="text" name="social_networks[twitter]" id="social_networks[twitter]" class="form__input" value="{{ auth()->user()->profile->social_networks['twitter'] ?? null }}">
                    </div>

                    <div class="form__group">
                        <label for="social_networks[youtube]">YouTube</label>
                        <input type="text" name="social_networks[youtube]" id="social_networks[youtube]" class="form__input" value="{{ auth()->user()->profile->social_networks['youtube'] ?? null }}">
                    </div>
                </div>
                <input type="submit" value="Save Profile" class="button">
            </div>
            <br>
        </form>
    </div>
</section>
@endsection
