<?php

namespace App\Jobs;

use App\Mail\Advertising;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendAdvertisingEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contact_submission;

    /**
    * Create a new job instance.
    *
    */
    public function __construct($contact_submission)
    {
        $this->contact_submission = $contact_submission;
    }

    /**
    * Execute the job.
    *
    */
    public function handle()
    {
        $email = new Advertising($this->contact_submission);

        Mail::to("stephen@fifteen.co.uk")->send($email);
    }
}
