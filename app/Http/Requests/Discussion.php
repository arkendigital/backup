<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Discussion extends FormRequest
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
            "name" => "required|string",
            "content" => "required",
            "category_id" => "required"
        ];
    }

    /**
     * Set the validation messages that display on error
     *
     * @return array
     *
     */
    public function messages()
    {
        return [
            "name.required" => "Enter a title",
            "content.required" => "Enter some content",
            "category_id.required" => "Select a category to add this too"
        ];
    }
}
