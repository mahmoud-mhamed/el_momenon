<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumberRule;
use App\Rules\PriceRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required', new SmallTextRule()
            ],
            'phone' => ['required', new PhoneNumberRule()],
            'salary' => ['required', new PriceRule()]
        ];
    }
}
