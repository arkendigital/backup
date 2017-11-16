@extends('mail.master')

@section('title')
Please Verify Your Email Address
@endsection

@section('button')
<p><a href="{{ url('/email/verify/'.$email_token) }}" class="button">Click here to verify your email</a></p>
<p><small>Can't click the button? Copy and paste this text into your browser window: {{ url('/email/verify/'.$email_token) }}</small></p>
@endsection

@section('content')
    <p>Hey <strong>{{ $user->name}}</strong>!</p>
    <p>Thanks for registering on GameFront.com.</p>
    <p>Before we can activate your account we need to verify your email address.</p>
    <p>Please click the button below to do so.</p>
@endsection
