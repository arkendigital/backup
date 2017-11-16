<?php

namespace App\Mail;

use App\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.user-verification')
                    ->with(['email_token' => $this->user->email_token, 'user' => $this->user])
                    ->subject('Please Verify Your Email Address on '. Setting::get('site_name') ?? env('APP_NAME'))
                    ->from('no-reply@fifteen.co.uk', Setting::get('site_name') ?? env('APP_NAME'));
    }
}
