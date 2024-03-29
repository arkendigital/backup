<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CPDResourceLink extends FormRequest
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
            "title" => "required|string|max:60",
            "subtitle" => "max:80",
            "text" => "max:500",
                        "link" => "url"
        ];
    }
}
