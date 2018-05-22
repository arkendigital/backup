@extends('mail.master')

@section('title')
New Feature Requested
@endsection

@section('content')
    <p>Hello, you have a new feature request.</p>
    <ul>
      <li>Name: {{ $submission->name }}</li>
      <li>Message: {{ $submission->message }}</li>
      <li>URL: {{ $submission->url }}</li>
    </ul>
@endsection
