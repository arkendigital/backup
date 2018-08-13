<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{

  /**
  * Create a new rule instance.
  *
  * @return void
  */
    public function __construct()
    {
    }

    /**
    * Determine if the validation rule passes.
    *
    * @param  string  $attribute
    * @param  mixed  $value
    * @return bool
    */
    public function passes($attribute, $value)
    {

    /**
    * Strip white space from the number.
    *
    */
        $phone_number = preg_replace('/\s+/', '', $value);

        /**
        * Check phone number is numbers only.
        *
        */
        if (!is_numeric($phone_number)) {
            return false;
        }

        /**
        * Check length of phone number, we want it between 9 and 13 characters.
        *
        */
        if (strlen($phone_number) >= 9 && strlen($phone_number) <= 13) {
            return $phone_number;
        } else {
            return false;
        }
    }

    /**
    * Get the validation error message.
    *
    * @return string
    */
    public function message()
    {
        return 'Please enter a valid phone number';
    }
}
