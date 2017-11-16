<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

use App\User;
use Carbon\Carbon;
use App\ConversationPost as Message;
use Cmgmyr\Messenger\Models\Participant;
use App\ConversationThread as Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $this->seo()->setTitle('All Conversations');

        $filter = request()->filter;

        // All threads, ignore deleted/archived participants
        // $threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        $threads = Thread::forUser(Auth::id())->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages(Auth::id())->latest('updated_at')->get();

        return view('messenger.index', compact('threads'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show(Thread $id)
    {
        $this->seo()->setTitle($id->subject);

        try {
            $thread = $id;
        } catch (ModelNotFoundException $e) {
            alert()->error('Conversation not found.');
            return redirect()->route('messageIndex');
        }

        $userId = Auth::id();

        if (!in_array($userId, $thread->participantsUserIds())) {
            alert()->error('You do not have permission to view this conversation');
            return redirect()->route('messageIndex');
        }

        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $this->seo()->setTitle('New Conversation');

        $users = User::where('id', '!=', Auth::id())->pluck('name', 'id');

        return view('messenger.create', compact('users'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();

        $recipients = [];
        $input['recipients'] = explode(',', $input['recipients'][0]);

        foreach ($input['recipients'] as $recipient) {
            $recipient = trim(str_replace('@', '', $recipient));
            if (!empty($recipient)) {
                $user = User::where('name', $recipient)->pluck('id')->first();
                $recipients[] = $user;
            }
        }

        $thread = Thread::create([
            'subject' => $input['subject'],
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $input['message'],
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon,
        ]);

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant($recipients);
        }

        return redirect()->route('messageIndex');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => Input::get('message'),
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }

        return redirect()->route('messageView', $id);
    }
}
