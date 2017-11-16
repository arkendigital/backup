@extends('layouts.master')

@section('breadcrumbs')
    {{ Breadcrumbs::render('messageView', $thread) }}
@endsection

@section('content')
<main class="site">
    <section class="site__container">
        <div class="col-3">
            @include('account.partials.sidebar')
        </div>
        <div class="col-9">
            <h3 class="forum__topic_title">
                <i class="fa fa-comment"></i> {{ $thread->subject }}
            </h3>

            @each('messenger.partials.messages', $thread->messages, 'message')
            @include('messenger.partials.form-message')
        </div>
    </section>
</main>
@endsection
