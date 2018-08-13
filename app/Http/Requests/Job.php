<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Job extends FormRequest
{

  /**
  * Determine if the user is authorized to make this request.
  *
  * @return bool
  */
    public function authorize()
    {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        $rules = [
            "title" => "required|string",
            "excerpt" => "required|string",
            "content" => "required|string",
            "status_id" => "required",
            "experience" => "required",
            "location_id" => "required",
            "company_id" => "required",
            "apply_link" => "required|url"
        ];

        if (request()->status_id == 1 || request()->status_id == 3) {
            $rules["min_salary"] = "required|numeric";
            $rules["max_salary"] = "required|numeric";
        }

        elseif (request()->status_id == 2) {
            $rules["min_daily_salary"] = "required|numeric";
            $rules["max_daily_salary"] = "required|numeric";
        }

        return $rules;
    }

    /**
     * Get validation rule messages
     *
     */
    public function messages()
    {
        return [
            "title.required" => "Please enter the job title. Eg: Financial Director",
            "excerpt.required" => "Please enter a short description for this job",
            "content.required" => "You must add a description for this job, such as what it entails and the roles involved",
            "min_salary.required" => "Please enter the minimum yearly salary for this job",
            "max_salary.required" => "Please enter the maximum yearly salary for this job",
            "daily_salary.required" => "Please enter the daily salary for this job",
            "status_id.required" => "Please select a job type",
            "sectors.required" => "Please select atleast 1 job sector",
            "experience.required" => "Please select the level of experience needed for this job",
            "location_id.required" => "You must select where this job is based",
            "company_id.required" => "Please select which company or recruiter this job is being posted by",
            "apply_link.required" => "Please enter the URL to which a user can apply for this job listing"
        ];
    }
}
