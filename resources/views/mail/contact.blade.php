@extends('mail.master')

@section('title')
New Contact Submission
@endsection

@section('content')
    <p>Hello, you have a new contact form submission.</p>
    <ul>
      <li>First Name: {{ $contact_submission->first_name }}</li>
      <li>Second Name: {{ $contact_submission->second_name }}</li>
      <li>Email: {{ $contact_submission->email }}</li>
      <li>Telephone: {{ $contact_submission->phone }}</li>
      <li>Comment: {{ $contact_submission->comment }}</li>
    </ul>
@endsection
