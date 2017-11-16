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
                <span class="box__title">Create a new conversation</span>
                <form action="{{ route('messageStore') }}" method="post" autocomplete="off">
                    {{ csrf_field() }}
                    <input type="text" class="form__input" id="recipients" name="recipients[]" placeholder="Recipients">
                    <input type="text"  class="form__input" name="subject" placeholder="Subject" value="{{ old('subject') }}">
                    <label>Message</label>
                    <textarea  class="js-editor" name="message">{{ old('message') }}</textarea>
                    @push('scripts-after')
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Caret.js/0.3.1/jquery.caret.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/at.js/1.5.4/js/jquery.atwho.min.js"></script>
                    <script>
                    $('#recipients').atwho({
                        at: "",
                        delay: 500,
                        callbacks: {
                            remoteFilter: function(query, callback) {
                                axios.get('/api/users?name='+ query)
                                    .then(function({data}){
                                        callback(data);
                                    });
                            }
                        },
                        insertTpl: "@${name},",
                    })
                    </script>
                    @endpush
                    <button class="button icon" type="submit">Start Conversation</button>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection

