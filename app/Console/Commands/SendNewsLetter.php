<?php

namespace App\Console\Commands;
use App\Models\Job;
use App\Mail\NewsLetter;
use Illuminate\Support\Carbon;
use \DrewM\MailChimp\MailChimp;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

class SendNewsLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $MailChimp = new MailChimp(env('MAILCHIMP_APIKEY'));

        $periodEnd = Carbon::now()->format('Y-m-d');
        $periodStart = Carbon::now()->subDays(7)->format('Y-m-d');
        $vacancies = Job::select('job_vacancies.*','job_companies.name as company_name')
                    ->withTrashed()
                    ->leftJoin('job_companies','job_companies.id','=','job_vacancies.company_id')
                    ->where(function($query) use($periodStart, $periodEnd){
                        $query->where('job_vacancies.created_at','>=',$periodStart)
                            ->where('job_vacancies.created_at','<',$periodEnd);
                    })
                    ->get();

        // return view('mail.newsletter', [
        //     'vacancies' => $vacancies
        // ]);
        $view = View::make('mail.newsletter', [
            'vacancies' => $vacancies
        ]);

        $html = $view->render();

        $templateResult = $MailChimp->post("templates", [
                        'name' => 'Weekly Newsletter '.date('d/m/Y'),
                        'html' => $html
                    ]);
        $templateId = $templateResult['id'];

        $campaignResult = $MailChimp->post("campaigns", [
                        'type' => 'regular',
                        'recipients'=>[
                            'list_id'=>env('MAILCHIMP_LISTID_CAMPAIGN')
                        ],
                        'settings'=>[
                            'subject_line'=>'Actuaries Online Newsletter '.date('d/m/Y'),
                            'title'=>'Newsletter',
                            'from_name'=>'Actuaries Online',
                            'reply_to'=>env('MAIL_FROM_ADDRESS'),
                            'template_id'=>$templateId
                        ]
                    ]);
        $campaignId = $campaignResult['id'];
        $result = $MailChimp->post("/campaigns/".$campaignId."/actions/send", []);
    }
}
