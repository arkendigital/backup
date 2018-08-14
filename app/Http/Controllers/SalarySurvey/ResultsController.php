<?php

namespace App\Http\Controllers\SalarySurvey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cache;
use App\Models\Section;
use App\Models\Page;
use App\Models\SalarySurvey;

class ResultsController extends Controller
{
    /**
     * Display results page.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get page information.
        $page = Page::getPage(request()->route()->uri);

        // Set SEO.
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);

        // Get adverts for this page.
        $page_adverts = getArrayOfAdverts($page->id);

        // Experience.
        $salary_vs_exerience_permanent = $this->averageSalaryVsExperience('permanent');
        $salary_vs_exerience_contractor = $this->averageSalaryVsExperience('contractor');
        // Sector/permanent
        $salary_sector_life_permanent = $this->salaryBySectorExeperience('life', 'permanent');
        $salary_sector_gi_permanent = $this->salaryBySectorExeperience('gi', 'permanent');
        $salary_sector_pensions_permanent = $this->salaryBySectorExeperience('pensions', 'permanent');
        $salary_sector_investments_permanent = $this->salaryBySectorExeperience('investments', 'permanent');
        $salary_sector_other_permanent = $this->salaryBySectorExeperience('other', 'permanent');
        // Sector/Contractor
        $salary_sector_life_contractor = $this->salaryBySectorExeperience('life', 'contractor');
        $salary_sector_gi_contractor = $this->salaryBySectorExeperience('gi', 'contractor');
        $salary_sector_pensions_contractor = $this->salaryBySectorExeperience('pensions', 'contractor');
        $salary_sector_investments_contractor = $this->salaryBySectorExeperience('investments', 'contractor');
        $salary_sector_other_contractor = $this->salaryBySectorExeperience('other', 'contractor');
        // Per Sector
        $salary_per_sector_permanent = $this->averageSalaryPerSector('permanent');
        $salary_per_sector_contractor = $this->averageSalaryPerSector('contractor');
        // Per Field
        $salary_per_field_permanent = $this->averageSalaryPerField('permanent');
        $salary_per_field_contractor = $this->averageSalaryPerField('contractor');

        return view('salary-survey.results', compact(
            'page',
            'page_adverts',
            'salary_vs_exerience_permanent',
            'salary_vs_exerience_contractor',
            'salary_per_sector_permanent',
            'salary_per_sector_contractor',
            'salary_per_field_permanent',
            'salary_per_field_contractor',
            'salary_sector_life_permanent',
            'salary_sector_life_contractor',
            'salary_sector_gi_permanent',
            'salary_sector_gi_contractor',
            'salary_sector_pensions_permanent',
            'salary_sector_pensions_contractor',
            'salary_sector_investments_permanent',
            'salary_sector_investments_contractor',
            'salary_sector_other_permanent',
            'salary_sector_other_contractor'
        ));
    }


    private function averageSalaryVsExperience($type)
    {
        // return Cache::remember('average_salary_vs_experience_' . $type, '60', function () use ($type) {
        $results = new \stdClass();

        if ($type == "contractor") {
            $avg_column = "daily_salary";
        } else {
            $avg_column = "annual_salary";
        }

        $one_four = SalarySurvey::where('experience', '1-4')
                ->where('type', $type)
                ->avg($avg_column);

        $five_nine = SalarySurvey::where('experience', '5-9')
                ->where('type', $type)
                ->avg($avg_column);

        $ten_fourteen = SalarySurvey::where('experience', '10-14')
                ->where('type', $type)
                ->avg($avg_column);

        $fifteen_ninteen = SalarySurvey::where('experience', '15-19')
                ->where('type', $type)
                ->avg($avg_column);

        $twenty_plus = SalarySurvey::where('experience', '20+')
                ->where('type', $type)
                ->avg($avg_column);

        if ($type != "contractor") {
            $results->one_four = round($one_four / 1000);
            $results->five_nine = round($five_nine / 1000);
            $results->ten_fourteen = round($ten_fourteen / 1000);
            $results->fifteen_ninteen = round($fifteen_ninteen / 1000);
            $results->twenty_plus = round($twenty_plus / 1000);
        } else {
            $results->one_four = $one_four;
            $results->five_nine = $five_nine;
            $results->ten_fourteen = $ten_fourteen;
            $results->fifteen_ninteen = $fifteen_ninteen;
            $results->twenty_plus = $twenty_plus;
        }

        return $results;
        // });
    }

    private function averageSalaryPerSector($type)
    {
        return Cache::remember('average_salary_per_sector_' . $type, '60', function () use ($type) {
            $results = new \stdClass();

            if ($type == "contractor") {
                $avg_column = "daily_salary";
            } else {
                $avg_column = "annual_salary";
            }

            $life = SalarySurvey::where('sector', 'life')
                ->where('type', $type)
                ->avg($avg_column);

            $gi = SalarySurvey::where('sector', 'gi')
                ->where('type', $type)
                ->avg($avg_column);

            $pensions = SalarySurvey::where('sector', 'pensions')
                ->where('type', $type)
                ->avg($avg_column);

            $investments = SalarySurvey::where('sector', 'investments')
                ->where('type', $type)
                ->avg($avg_column);

            $other = SalarySurvey::where('sector', 'other')
                ->where('type', $type)
                ->avg($avg_column);

            if ($type != "contractor") {
                $results->life = round($life / 1000);
                $results->gi = round($gi / 1000);
                $results->pensions = round($pensions / 1000);
                $results->investments = round($investments / 1000);
                $results->other = round($other / 1000);
            } else {
                $results->life = $life;
                $results->gi = $gi;
                $results->pensions = $pensions;
                $results->investments = $investments;
                $results->other = $other;
            }

            return $results;
        });
    }


    private function averageSalaryPerField($type)
    {
        return Cache::remember('average_salary_per_field_' . $type, '60', function () use ($type) {
            $results = new \stdClass();

            if ($type == "contractor") {
                $avg_column = "daily_salary";
            } else {
                $avg_column = "annual_salary";
            }

            $consultancy = SalarySurvey::where('field', 'consultancy')
                ->where('type', $type)
                ->avg($avg_column);

            $insurance = SalarySurvey::where('field', 'insurance')
                ->where('type', $type)
                ->avg($avg_column);

            $reinsurance = SalarySurvey::where('field', 'reinsurance')
                ->where('type', $type)
                ->avg($avg_column);

            $other = SalarySurvey::where('field', 'other')
                ->where('type', $type)
                ->avg($avg_column);

            if ($type != "contractor") {
                $results->consultancy = round($consultancy / 1000);
                $results->insurance = round($insurance / 1000);
                $results->reinsurance = round($reinsurance / 1000);
                $results->other = round($other / 1000);
            } else {
                $results->consultancy = $consultancy;
                $results->insurance = $insurance;
                $results->reinsurance = $reinsurance;
                $results->other = $other;
            }

            return $results;
        });
    }

    private function salaryBySectorExeperience($sector, $type)
    {
        return Cache::remember('average_salary_sector_'. $sector .'_'. $type, '60', function () use ($sector, $type) {
            $results = new \stdClass();

            if ($type == "contractor") {
                $avg_column = "daily_salary";
            } else {
                $avg_column = "annual_salary";
            }

            $one_four = SalarySurvey::where('experience', '1-4')
                ->where('type', $type)
                ->where('sector', $sector)
                ->avg($avg_column);

            $five_nine = SalarySurvey::where('experience', '5-9')
                ->where('type', $type)
                ->where('sector', $sector)
                ->avg($avg_column);

            $ten_fourteen = SalarySurvey::where('experience', '10-14')
                ->where('type', $type)
                ->where('sector', $sector)
                ->avg($avg_column);

            $fifteen_ninteen = SalarySurvey::where('experience', '15-19')
                ->where('type', $type)
                ->where('sector', $sector)
                ->avg($avg_column);

            $twenty_plus = SalarySurvey::where('experience', '20+')
                ->where('type', $type)
                ->where('sector', $sector)
                ->avg($avg_column);

            if ($type != "contractor") {
                $results->one_four = round($one_four / 1000);
                $results->five_nine = round($five_nine / 1000);
                $results->ten_fourteen = round($ten_fourteen / 1000);
                $results->fifteen_ninteen = round($fifteen_ninteen / 1000);
                $results->twenty_plus = round($twenty_plus / 1000);
            } else {
                $results->one_four = $one_four;
                $results->five_nine = $five_nine;
                $results->ten_fourteen = $ten_fourteen;
                $results->fifteen_ninteen = $fifteen_ninteen;
                $results->twenty_plus = $twenty_plus;
            }

            return $results;
        });
    }

    /**
     * Download the survey results
     *
     */
    public function download()
    {
        $this->seo()
            ->setTitle("Download Salary Survey Results");

        // Experience.
        $salary_vs_exerience_permanent = $this->averageSalaryVsExperience('permanent');
        $salary_vs_exerience_contractor = $this->averageSalaryVsExperience('contractor');
        // Sector/permanent
        $salary_sector_life_permanent = $this->salaryBySectorExeperience('life', 'permanent');
        $salary_sector_gi_permanent = $this->salaryBySectorExeperience('gi', 'permanent');
        $salary_sector_pensions_permanent = $this->salaryBySectorExeperience('pensions', 'permanent');
        $salary_sector_investments_permanent = $this->salaryBySectorExeperience('investments', 'permanent');
        $salary_sector_other_permanent = $this->salaryBySectorExeperience('other', 'permanent');
        // Sector/Contractor
        $salary_sector_life_contractor = $this->salaryBySectorExeperience('life', 'contractor');
        $salary_sector_gi_contractor = $this->salaryBySectorExeperience('gi', 'contractor');
        $salary_sector_pensions_contractor = $this->salaryBySectorExeperience('pensions', 'contractor');
        $salary_sector_investments_contractor = $this->salaryBySectorExeperience('investments', 'contractor');
        $salary_sector_other_contractor = $this->salaryBySectorExeperience('other', 'contractor');
        // Per Sector
        $salary_per_sector_permanent = $this->averageSalaryPerSector('permanent');
        $salary_per_sector_contractor = $this->averageSalaryPerSector('contractor');
        // Per Field
        $salary_per_field_permanent = $this->averageSalaryPerField('permanent');
        $salary_per_field_contractor = $this->averageSalaryPerField('contractor');

        return view('salary-survey.results-download', compact(
            'salary_vs_exerience_permanent',
            'salary_vs_exerience_contractor',
            'salary_per_sector_permanent',
            'salary_per_sector_contractor',
            'salary_per_field_permanent',
            'salary_per_field_contractor',
            'salary_sector_life_permanent',
            'salary_sector_life_contractor',
            'salary_sector_gi_permanent',
            'salary_sector_gi_contractor',
            'salary_sector_pensions_permanent',
            'salary_sector_pensions_contractor',
            'salary_sector_investments_permanent',
            'salary_sector_investments_contractor',
            'salary_sector_other_permanent',
            'salary_sector_other_contractor'
        ));
    }
}
