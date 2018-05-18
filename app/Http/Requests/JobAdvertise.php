<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobAdvertise extends FormRequest
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
            "company_name" => "required|string",
            "name" => "required|string",
            "email" => "required|email|string|confirmed",
            "phone" => "required|numeric",
            "comment" => "required"
        ];
    }

    /**
     * Set messages to show on failed validation
     *
     * @return array
     *
     */
    public function messages()
    {
        return [
            "company_name.required" => "Please enter your company name",
            "name.required" => "Please enter your name",
            "email.required" => "Please enter your email",
            "email.email" => "Enter a valid email address",
            "email.confirmed" => "Your email and confirmation email do not match",
            "phone.required" => "Enter your phone number",
            "phone.numeric" => "Enter a valid phone number without spaces",
            "comment.required" => "Please enter a comment"
        ];
    }
}
