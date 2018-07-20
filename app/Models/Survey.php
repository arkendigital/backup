<?php

namespace App\Models;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Exam\Module as ExamModule;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model implements WithHeadings, FromCollection
{
    use Exportable;

    /**
     * Excel headings
     *
     */
    public function headings(): array
    {
        return [
            "Module",
            "Difficulty",
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

        $survey_data = Survey::select("module_id", "difficulty", "created_at")
            ->get();

        foreach ($survey_data as $data) {
            if ($data->module) {
                $export_data->push([
                    $data->module->name,
                    $data->difficulty,
                    $data->created_at
                ]);
            }
        }

        return $export_data;

    }

    protected $fillable = [
        "module_id",
        "difficulty"
    ];

    protected $table = 'survey';

    public $timestamps = true;

    /**
    * A module has some information.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    *
    */
    public function module()
    {
        return $this->hasOne(ExamModule::class, 'id', 'module_id');
    }
}
