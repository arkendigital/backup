<?php

namespace App\Mail;

use App\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Advertising extends Mailable
{
    use Queueable, SerializesModels;

    protected $contact_submission;

    /**
    * Create a new message instance.
    */
    public function __construct($contact_submission)
    {
        $this->contact_submission = $contact_submission;
    }

    /**
    * Build the message.
    *
    * @return $this
    */
    public function build()
    {
        return $this->view('mail.advertising')
      ->with(['contact_submission' => $this->contact_submission])
      ->subject('New advertising contact form submission on '. Setting::get('site_name') ?? env('APP_NAME'))
      ->from('no-reply@fifteen.co.uk', Setting::get('site_name') ?? env('APP_NAME'));
    }
}
