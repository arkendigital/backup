<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamResource extends FormRequest
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
            "name" => "required|string|max:60",
            "excerpt" => "required|string|max:80"
        ];

        if (request()->link != "") {
          $rules["link"] = "url";
        }

        return $rules;
    }
}
