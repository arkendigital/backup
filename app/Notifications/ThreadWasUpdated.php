<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ThreadWasUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $thread;
    protected $post;

    /**
     * Create a new notification instance.
     *
     * @param $thread
     * @param $post
     */
    public function __construct($thread, $post)
    {
        $this->thread = $thread;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'author'    => $this->post->profile,
            'title'     => $this->thread->title,
            'message'   => $this->post->profile->display_name .' said: '. str_limit($this->post->content, 45),
            'link'      => $this->thread->url()
        ];
    }
}
