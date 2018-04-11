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
        return [
            "title" => "required|string",
            "excerpt" => "required|string",
            "content" => "required|string",
            "salary" => "required|numeric",
            "location_id" => "required",
            "company_id" => "required",
            "apply_link" => "required|url"
        ];
    }
}
