<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\SalarySurvey;

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
}
