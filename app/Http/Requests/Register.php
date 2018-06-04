<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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
            "name" => "required|string|max:100",
            "email" => "required|string|email|max:255|unique:users",
            "username" => "required|string|max:50|unique:users",
            /*
             * These are being removed as mandatory, for now
             *
            "arn" => "required",
            "current_role" => "required",
            "company_name" => "required",
            "location" => "required",
            "experience" => "required",
            */
            "password" => "required|string|min:6",
            "terms" => "required",
            "privacy" => "required"
        ];
    }

    /**
     * Set messages for invalid validation
     *
     * @return array
     *
     */
    public function messages()
    {
        return [
            "name.required" => "Please enter your full name",
            "name.max" => "The name you have entered is too long",
            "email.required" => "Please enter your email address",
            "email.email" => "Enter a valid email address",
            "email.unique" => "This email address is already in use",
            "username.required" => "Please enter a username",
            "username.max" => "The username you have entered is too long",
            "username.unqiue" => "This username is already in use",
            "arn.required" => "Please enter your Actuarial Reference Number",
            "current_role.required" => "Please enter your current role",
            "company_name.required" => "Please enter the company name you work with",
            "location.required" => "Please enter your location",
            "experience.required" => "Please select your years of experience",
            "password.required" => "Please enter a password",
            "password.min" => "Password is to short, must be at least 6 characters",
            "terms.required" => "You must agree to our terms and conditions in order to register",
            "privacy.required" => "You must agree to our cookies and privacy policy in order to register"
        ];
    }
}
