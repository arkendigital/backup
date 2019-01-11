<?php

namespace App\Mail;

use App\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuggestFeature extends Mailable
{
    use Queueable, SerializesModels;

    protected $submission;

    /**
    * Create a new message instance.
    */
    public function __construct($submission)
    {
        $this->submission = $submission;
    }

    /**
    * Build the message.
    *
    * @return $this
    */
    public function build()
    {
        return $this->view('mail.feature')
            ->with(['submission' => $this->submission])
            ->subject('New feature requested on '. Setting::get('site_name') ?? env('APP_NAME'))
            ->from('no-reply@actuariesonline.com', Setting::get('site_name') ?? env('APP_NAME'));
    }
}
