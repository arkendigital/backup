<?php

namespace App\Jobs;

use App\Mail\SuggestFeature;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;
use App\Setting;

class SendSuggestFeatureEmail //implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $submission;

    /**
    * Create a new job instance.
    *
    */
    public function __construct($submission)
    {
        $this->submission = $submission;
    }

    /**
    * Execute the job.
    *
    */
    public function handle()
    {
        $email = new SuggestFeature($this->submission);

        Mail::to(Setting::get('admin_email'))->send($email);
    }
}
