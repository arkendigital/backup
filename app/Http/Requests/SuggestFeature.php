<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuggestFeature extends FormRequest
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
            "name" => "required|string|max:75",
            "message" => "required",
        ];
    }

    /**
     * Set the messages that will appear on failed validation
     *
     * @return array
     *
     */
    public function messages()
    {
        return [
            "name.required" => "Please enter your name",
            "message.required" => "Tell us about your suggested feature idea"
        ];
    }
}
