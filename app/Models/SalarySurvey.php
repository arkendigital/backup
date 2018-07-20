<?php

namespace App\Models;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Database\Eloquent\Model;

class SalarySurvey extends Model implements WithHeadings, FromCollection
{
    use Exportable;

    /**
     * Excel headings
     *
     */
    public function headings(): array
    {
        return [
            "Type",
            "Sector",
            "Field",
            "Experience",
            "Qualifications",
            "Annual Salary",
            "Daily Salary",
            "User ID",
            "Created At"
        ];
    }

    /**
     * Prepare the data to be exported to excel file
     *
     */
    public function collection()
    {

        $export_data = collect();

        $survey_data = SalarySurvey::select("type", "sector", "field", "experience", "qualifications", "annual_salary", "daily_salary", "user_id", "created_at")
            ->get();

        foreach ($survey_data as $data) {
            $export_data->push([
                $data->type,
                $data->sector,
                $data->field,
                $data->experience,
                $data->qualifications,
                $data->annual_salary,
                $data->daily_salary,
                $data->user_id,
                $data->created_at
            ]);
        }

        return $export_data;

    }

    /**
     * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        "type",
        "sector",
        "field",
        "experience",
        "qualifications",
        "annual_salary",
        "daily_salary",
        "user_id"
    ];

    protected $table = 'salary_survery';

    public $timestamps = true;
}
