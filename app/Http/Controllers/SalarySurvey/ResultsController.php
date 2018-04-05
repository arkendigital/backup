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
     *
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
        $salary_sector_life_consultant = $this->salaryBySectorExeperience('life', 'contractor');
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
            'salary_sector_life_consultant'
        ));
    }


    private function averageSalaryVsExperience($type)
    {
        return Cache::remember('average_salary_vs_experience_' . $type, '60', function () use ($type) {
            $results = new \stdClass();

            $one_four = SalarySurvey::where('experience', '1-4')
                ->where('type', $type)
                ->avg('annual_salary');

            $five_nine = SalarySurvey::where('experience', '5-9')
                ->where('type', $type)
                ->avg('annual_salary');

            $ten_fourteen = SalarySurvey::where('experience', '10-14')
                ->where('type', $type)
                ->avg('annual_salary');

            $fifteen_ninteen = SalarySurvey::where('experience', '15-19')
                ->where('type', $type)
                ->avg('annual_salary');

            $twenty_plus = SalarySurvey::where('experience', '20+')
                ->where('type', $type)
                ->avg('annual_salary');
          
            $results->one_four = round($one_four / 1000);
            $results->five_nine = round($five_nine / 1000);
            $results->ten_fourteen = round($ten_fourteen / 1000);
            $results->fifteen_ninteen = round($fifteen_ninteen / 1000);
            $results->twenty_plus = round($twenty_plus / 1000);

            return $results;
        });
    }

    private function averageSalaryPerSector($type)
    {
        return Cache::remember('average_salary_per_sector_' . $type, '60', function () use ($type) {
            $results = new \stdClass();

            $life = SalarySurvey::where('sector', 'life')
                ->where('type', $type)
                ->avg('annual_salary');

            $gi = SalarySurvey::where('sector', 'gi')
                ->where('type', $type)
                ->avg('annual_salary');

            $pensions = SalarySurvey::where('sector', 'pensions')
                ->where('type', $type)
                ->avg('annual_salary');

            $investments = SalarySurvey::where('sector', 'investments')
                ->where('type', $type)
                ->avg('annual_salary');

            $other = SalarySurvey::where('sector', 'other')
                ->where('type', $type)
                ->avg('annual_salary');

            $results->life = round($life / 1000);
            $results->gi = round($gi / 1000);
            $results->pensions = round($pensions / 1000);
            $results->investments = round($investments / 1000);
            $results->other = round($other / 1000);

            return $results;
        });
    }

     
    private function averageSalaryPerField($type)
    {
        return Cache::remember('average_salary_per_field_' . $type, '60', function () use ($type) {
            $results = new \stdClass();

            $consultancy = SalarySurvey::where('field', 'consultancy')
                ->where('type', $type)
                ->avg('annual_salary');

            $insurance = SalarySurvey::where('field', 'insurance')
                ->where('type', $type)
                ->avg('annual_salary');

            $reinsurance = SalarySurvey::where('field', 'reinsurance')
                ->where('type', $type)
                ->avg('annual_salary');

            $other = SalarySurvey::where('field', 'other')
                ->where('type', $type)
                ->avg('annual_salary');

            $results->consultancy = round($consultancy / 1000);
            $results->insurance = round($insurance / 1000);
            $results->reinsurance = round($reinsurance / 1000);
            $results->other = round($other / 1000);

            return $results;
        });
    }

    private function salaryBySectorExeperience($sector, $type)
    {
        return Cache::remember('average_salary_sector_'. $sector .'_'. $type, '60', function () use ($sector, $type) {
            $results = new \stdClass();

            $one_four = SalarySurvey::where('experience', '1-4')
                ->where('type', $type)
                ->where('sector', $sector)
                ->avg('annual_salary');

            $five_nine = SalarySurvey::where('experience', '5-9')
                ->where('type', $type)
                ->where('sector', $sector)
                ->avg('annual_salary');

            $ten_fourteen = SalarySurvey::where('experience', '10-14')
                ->where('type', $type)
                ->where('sector', $sector)
                ->avg('annual_salary');

            $fifteen_ninteen = SalarySurvey::where('experience', '15-19')
                ->where('type', $type)
                ->where('sector', $sector)
                ->avg('annual_salary');

            $twenty_plus = SalarySurvey::where('experience', '20+')
                ->where('type', $type)
                ->where('sector', $sector)
                ->avg('annual_salary');

            $results->one_four = round($one_four / 1000);
            $results->five_nine = round($five_nine / 1000);
            $results->ten_fourteen = round($ten_fourteen / 1000);
            $results->fifteen_ninteen = round($fifteen_ninteen / 1000);
            $results->twenty_plus = round($twenty_plus / 1000);

            return $results;
        });
    }
}
