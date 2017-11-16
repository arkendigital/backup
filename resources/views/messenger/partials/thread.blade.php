<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>
<tr>
    <td><a title="{{ $thread->subject }}" href="{{ route('messageView', $thread->id) }}">
            <a href="{{ route('messageView', $thread->id) }}">{{ $thread->subject }}</a>
        </a>
    </td>
    <td>
        {{ $thread->userUnreadMessagesCount(Auth::id()) }} unread
    </td>
    <td> {{ $thread->creator()->name }}</td>
    <td>{{ $thread->participantsString(Auth::id()) }}</td>
</tr>

