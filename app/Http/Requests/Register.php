<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest {

  /**
  * Determine if the user is authorized to make this request.
  *
  * @return bool
  */
  public function authorize() {
    return true;
  }

  /**
  * Get the validation rules that apply to the request.
  *
  * @return array
  */
  public function rules() {
    return [
      "name" => "required|string|max:100",
      "email" => "required|string|email|max:255|unique:users",
      "username" => "required|string|max:50|unique:users",
      "password" => "required|string|min:6"
    ];
  }

}
