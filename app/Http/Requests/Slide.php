<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Slide extends FormRequest
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
            "title" => "required|string|max:50",
            "text" => "required|string|max:150",
            "slug" => "required|string"
        ];
    }
}
