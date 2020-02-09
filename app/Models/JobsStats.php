<?php

namespace App\Models;

use App\Models\JobApply;
use App\Models\JobClick;
use App\Models\JobEmail;
use App\Models\JobImpression;
use App\Models\JobUniqueImpression;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class JobsStats extends Model
{
    protected $table = 'job_vacancies';

    public function download($file_name, $vacancies,$start_date,$end_date)
    {
        \Excel::create($file_name, function ($excel) use($vacancies,$start_date,$end_date){
            $excel->sheet('Sheetname', function ($sheet) use($vacancies,$start_date,$end_date){
                $sheet->appendRow([
                    "Job ID",
                    "Date job displayed",
                    "Period posted",
                    "Job Title",
                    "Impressions",
                    "Clicks",
                    "Click %",
                    "Apply",
                    "Contact",
                ]);

                foreach ($vacancies as $vacancy) {
                    /**
                     * Get stats for this advert
                     */
                    $impressions = JobImpression::where("job_id", $vacancy->id)
                        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
                        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
                        ->count();

                    $unique_impressions = JobUniqueImpression::where("job_id", $vacancy->id)
                        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
                        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
                        ->count();

                    $clicks = JobClick::where("job_id", $vacancy->id)
                        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
                        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
                        ->count();

                    if ($clicks !== 0 && $impressions !== 0) {
                        $click_rate = number_format($clicks / $impressions * 100);
                    } else {
                        $click_rate = 0;
                    }

                    $applies = JobApply::where("job_id", $vacancy->id)
                        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
                        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
                        ->count();

                    $emails = JobEmail::where("job_id", $vacancy->id)
                        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
                        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
                        ->count();


                    $sheet->appendRow([
                        $vacancy->id,
                        Carbon::createFromFormat('Y-m-d H:i:s', $vacancy->created_at)->format('d/m/Y'),
                        Carbon::createFromFormat('d-m-Y', $vacancy->start_date)->format('d/m/Y').' to '.Carbon::createFromFormat('d-m-Y', $vacancy->end_date)->format('d/m/Y'),
                        $vacancy->title,
                        $unique_impressions,
                        $clicks,
                        $click_rate,
                        $applies,
                        $emails
                    ]);
                }
            });
        })->export('xls');
    }

    /**
     * Excel headings
     *
     */
    // public function headings(): array
    // {
    //     return [
    //         "Date job displayed",
    //         "Period posted",
    //         "Job Title",
    //         "Impressions",
    //         "Clicks",
    //         "Click %",
    //         "Apply"
    //     ];
    // }

    /**
     * Prepare the data to be exported to excel file
     *
     */
    // public function collection()
    // {
    //     $export_data = collect();

    //     $survey_data = SalarySurvey::select("type", "sector", "field", "experience", "qualifications", "annual_salary", "daily_salary", "user_id", "created_at")
    //         ->get();

    //     foreach ($survey_data as $data) {
    //         $export_data->push([
    //             $data->type,
    //             $data->sector,
    //             $data->field,
    //             $data->experience,
    //             $data->qualifications,
    //             $data->annual_salary,
    //             $data->daily_salary,
    //             $data->user_id,
    //             $data->created_at
    //         ]);
    //     }

    //     return $export_data;
    // }

    /**
     * The attributes that are mass assignable.
    *
    * @var array
    */
    // protected $fillable = [
    //     "type",
    //     "sector",
    //     "field",
    //     "experience",
    //     "qualifications",
    //     "annual_salary",
    //     "daily_salary",
    //     "user_id"
    // ];

    

    // public $timestamps = true;
}
