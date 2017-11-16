@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render() }}
@endsection

@section('content')
{{-- Not quite sure what this does. --}}
@unless( $forum->threads->isEmpty() )

    @foreach ( $forum->threads as $thread )

    @endforeach

@endunless

@endsection
