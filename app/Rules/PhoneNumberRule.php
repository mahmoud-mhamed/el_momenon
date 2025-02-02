<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneNumberRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validator = preg_match("/^(009665|9665|\+9665|05|5)([503649187])(\d{7})$/", $value);

        if (!$validator) {
            $fail( __('validation.phone'));
        }
    }
}
