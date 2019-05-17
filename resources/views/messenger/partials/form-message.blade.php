<div class="box box--with-margin">
    <span class="box__title">Add a new message</span>
    <form action="{{ route('messageUpdate', $thread->id) }}" method="post">
        {{ method_field('put') }}
        {{ csrf_field() }}
        <textarea name="message" class="js-editor">{{ old('message') }}</textarea>
        <!-- Submit Form Input -->
        <button class="button" type="submit">Post Reply</button>
    </form>
</div>
