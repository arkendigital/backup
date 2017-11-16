<div class="box box--with-margin">
    <span class="box__title">Control Panel</span>
    <div class="box__content">
        <p><a href="{{ route('myAccount') }}">Main Page</a></p>
        <hr>
        <p><a href="{{ route('accountEdit') }}">Edit Account</a></p>
        <hr>
        <p><a href="{{ route('profileEdit') }}">Edit Profile</a></p>
        <hr>
        <p><a href="{{ route('me', auth()->user()->profile) }}">Your Profile</a></p>
    </div>
</div>

<div class="box box--with-margin">
    <span class="box__title">Private Conversations</span>
    <div class="box__content">
        <p><a href="{{ route('messageCreate') }}">New Conversation</a></p>
        <hr>
        <p><a href="{{ route('messageIndex') }}">View Conversations</a></p>
    </div>
</div>
