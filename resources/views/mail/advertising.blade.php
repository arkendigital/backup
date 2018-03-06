@extends('mail.master')

@section('title')
New Advertising Contact Submission
@endsection

@section('content')
    <p>Hello, you have a new advertising contact form submission.</p>
    <ul>
      <li>Company Name: {{ $contact_submission->company_name }}</li>
      <li>Name: {{ $contact_submission->name }}</li>
      <li>Email: {{ $contact_submission->email }}</li>
      <li>Telephone: {{ $contact_submission->phone }}</li>
      <li>Comment: {{ $contact_submission->comment }}</li>
    </ul>
@endsection
