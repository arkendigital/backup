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
                <div class="u-pull-right">
                    <a href="{{ route('messageCreate') }}" class="button orange">New Conversation</a>
                </div>
                <table width="100%" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Messages</th>
                            <th>Creator</th>
                            <th>Participants</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('messenger.partials.flash')
                        @each('messenger.partials.thread', $threads, 'thread')
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
@endsection
