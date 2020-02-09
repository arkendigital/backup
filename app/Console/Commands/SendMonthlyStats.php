<?php

namespace App\Console\Commands;
use App\Mail\MonthlyJobsStats;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMonthlyStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_monthly_stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to admin with an excel sheet for monthly jobs stats attached';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // return (new JobsStats)->download(date('F').'_jobs_stats',$vacancies,$start_date,$end_date);
        $email = new MonthlyJobsStats();
        Mail::to(Setting::get('admin_email'))->send($email);
    }
}
