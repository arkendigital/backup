<?php

return [

    'user_model' => App\User::class,

    'message_model' => App\ConversationPost::class,

    'participant_model' => Cmgmyr\Messenger\Models\Participant::class,

    'thread_model' => App\ConversationThread::class,

    /**
     * Define custom database table names - without prefixes.
     */
    'messages_table' => 'messenger_messages',
    'participants_table' => 'messenger_participants',
    'threads_table' => 'messenger_threads',
];
