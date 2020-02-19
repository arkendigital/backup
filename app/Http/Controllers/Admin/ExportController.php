<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobsStats;
use App\Models\SalarySurvey;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExportController extends Controller
{
    public function exam()
    {
        return (new Survey)->download('exam_survey_raw_data');

        return redirect()->back();
    }

    public function salary()
    {
        return (new SalarySurvey)->download('salary_survey_raw_data');

        return redirect()->back();
    }

    public function jobs(Request $request)
    {
        if ($request->exists("dates")) {
            $dates = explode(" - ", $request->dates);
            $periodStart = Carbon::createFromFormat('d-m-Y', $dates[0])->format('Y-m-d');
            $periodEnd = Carbon::createFromFormat('d-m-Y', $dates[1])->format('Y-m-d');
        } else {
            $periodStart = Carbon::now()->firstOfMonth()->format('Y-m-d');
            $periodEnd = Carbon::now()->lastOfMonth()->format('Y-m-d');
        }

        //jobs that started within the month (period)
        //or ended withing the month (period)
        $vacancies = Job::select('job_vacancies.*','job_companies.name as company_name')
                        ->withTrashed()
                        ->leftJoin('job_companies','job_companies.id','=','job_vacancies.company_id')
                        ->where(function($query) use($periodStart){
                            $query->where('start_date','<=',$periodStart)
                                ->where('end_date','>=',$periodStart);
                        })
                        ->orWhere(function($query) use($periodEnd){
                            $query->where('start_date','<=',$periodEnd)
                                ->where('end_date','>=',$periodEnd);
                        })
                        ->get();
                        
        return (new JobsStats)->download($periodStart.'-'.$periodEnd.'-jobs-stats',$vacancies,$periodStart,$periodEnd);
        return redirect()->back();
    }
}
