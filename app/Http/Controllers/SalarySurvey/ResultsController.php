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

        // Get graph results.
        $graph_one = $this->averageSalaryVsExperiencePermanant();
        $graph_two = $this->averageSalaryVsExperienceContractor();
        $salary_per_sector_permanant = $this->averageSalaryPerSectorPermanant();
        $salary_per_sector_contractor = $this->averageSalaryPerSectorContractor();
        $salary_per_field_permanant = $this->averageSalaryPerFieldPermanant();
        $salary_per_field_contractor = $this->averageSalaryPerFieldContractor();

        return view("salary-survey.results", compact(
            'page',
            'page_adverts',
            'graph_one',
            'graph_two',
            'salary_per_sector_permanant',
            'salary_per_sector_contractor',
            'salary_per_field_permanant',
            'salary_per_field_contractor'
        ));
    }

    private function averageSalaryVsExperiencePermanant()
    {
        return Cache::remember('average_salary_vs_experience_permanant', '60', function () {
            $results = new \stdClass();

            $results->one_four = round(SalarySurvey::where("experience", "1-4")
            ->avg("annual_salary") / 1000);

            $results->five_nine = round(SalarySurvey::where("experience", "5-9")
            ->avg("annual_salary") / 1000);

            $results->ten_fourteen = round(SalarySurvey::where("experience", "10-14")
            ->avg("annual_salary") / 1000);

            $results->fifteen_ninteen = round(SalarySurvey::where("experience", "15-19")
            ->avg("annual_salary") / 1000);

            $results->twenty_plus = round(SalarySurvey::where("experience", "20+")
            ->avg("annual_salary") / 1000);

            return $results;
        });
    }

    private function averageSalaryVsExperienceContractor()
    {
        return Cache::remember('average_salary_vs_experience_contractor', '60', function () {
            $results = new \stdClass();

            $one_four = SalarySurvey::where("experience", "1-4")
            ->where('type', 'contractor')
            ->avg("annual_salary");

            $five_nine = SalarySurvey::where("experience", "5-9")
            ->where('type', 'contractor')
            ->avg("annual_salary");

            $ten_fourteen = SalarySurvey::where("experience", "10-14")
            ->where('type', 'contractor')
            ->avg("annual_salary");

            $fifteen_ninteen = SalarySurvey::where("experience", "15-19")
            ->where('type', 'contractor')
            ->avg("annual_salary");

            $twenty_plus = SalarySurvey::where("experience", "20+")
            ->where('type', 'contractor')
            ->avg("annual_salary");
          
            $results->one_four = round($one_four / 1000);
            $results->five_nine = round($five_nine / 1000);
            $results->ten_fourteen = round($ten_fourteen / 1000);
            $results->fifteen_ninteen = round($fifteen_ninteen / 1000);
            $results->twenty_plus = round($twenty_plus / 1000);

            return $results;
        });
    }

    public function averageSalaryPerSectorPermanant()
    {
        return Cache::remember('average_salary_per_sector_permanat', '60', function () {
            $results = new \stdClass();

            $life = SalarySurvey::where('sector', 'life')
                ->where('type', 'permanent')
                ->avg('annual_salary');

            $gi = SalarySurvey::where('sector', 'gi')
                ->where('type', 'permanent')
                ->avg('annual_salary');

            $pensions = SalarySurvey::where('sector', 'pensions')
                ->where('type', 'permanent')
                ->avg('annual_salary');

            $investments = SalarySurvey::where('sector', 'investments')
                ->where('type', 'permanent')
                ->avg('annual_salary');

            $other = SalarySurvey::where('sector', 'other')
                ->where('type', 'permanent')
                ->avg('annual_salary');

            $results->life = round($life / 1000);
            $results->gi = round($gi / 1000);
            $results->pensions = round($pensions / 1000);
            $results->investments = round($investments / 1000);
            $results->other = round($other / 1000);

            return $results;
        });
    }

    public function averageSalaryPerSectorContractor()
    {
        return Cache::remember('average_salary_per_sector_contractor', '60', function () {
            $results = new \stdClass();

            $life = SalarySurvey::where('sector', 'life')
                ->where('type', 'contractor')
                ->avg('annual_salary');

            $gi = SalarySurvey::where('sector', 'gi')
                ->where('type', 'contractor')
                ->avg('annual_salary');

            $pensions = SalarySurvey::where('sector', 'pensions')
                ->where('type', 'contractor')
                ->avg('annual_salary');

            $investments = SalarySurvey::where('sector', 'investments')
                ->where('type', 'contractor')
                ->avg('annual_salary');

            $other = SalarySurvey::where('sector', 'other')
                ->where('type', 'contractor')
                ->avg('annual_salary');

            $results->life = round($life / 1000);
            $results->gi = round($gi / 1000);
            $results->pensions = round($pensions / 1000);
            $results->investments = round($investments / 1000);
            $results->other = round($other / 1000);
            
            return $results;
        });
    }
     
    public function averageSalaryPerFieldPermanant()
    {
        return Cache::remember('average_salary_per_field_permanant', '60', function () {
            $results = new \stdClass();

            $consultancy = SalarySurvey::where('field', 'consultancy')
                ->where('type', 'permanent')
                ->avg('annual_salary');

            $insurance = SalarySurvey::where('field', 'insurance')
                ->where('type', 'permanent')
                ->avg('annual_salary');

            $reinsurance = SalarySurvey::where('field', 'reinsurance')
                ->where('type', 'permanent')
                ->avg('annual_salary');

            $other = SalarySurvey::where('field', 'other')
                ->where('type', 'permanent')
                ->avg('annual_salary');

            $results->consultancy = round($consultancy / 1000);
            $results->insurance = round($insurance / 1000);
            $results->reinsurance = round($reinsurance / 1000);
            $results->other = round($other / 1000);

            return $results;
        });
    }

    public function averageSalaryPerFieldContractor()
    {
        return Cache::remember('average_salary_per_field_contractor', '60', function () {
            $results = new \stdClass();

            $consultancy = SalarySurvey::where('field', 'consultancy')
                ->where('type', 'contractor')
                ->avg('annual_salary');

            $insurance = SalarySurvey::where('field', 'insurance')
                ->where('type', 'contractor')
                ->avg('annual_salary');

            $reinsurance = SalarySurvey::where('field', 'reinsurance')
                ->where('type', 'contractor')
                ->avg('annual_salary');

            $other = SalarySurvey::where('field', 'other')
                ->where('type', 'contractor')
                ->avg('annual_salary');

            $results->consultancy = round($consultancy / 1000);
            $results->insurance = round($insurance / 1000);
            $results->reinsurance = round($reinsurance / 1000);
            $results->other = round($other / 1000);

            return $results;
        });
    }
}
