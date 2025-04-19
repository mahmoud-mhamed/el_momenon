<?php

namespace App\Http\Requests;

use App\Rules\DateFormatCreatedAtRule;
use App\Rules\LargeTextRule;
use App\Rules\PriceRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required',new SmallTextRule()],
            'amount' => ['required',new PriceRule()],
            'operation_date' => ['required',new DateFormatCreatedAtRule()],
            'note' => ['nullable',new LargeTextRule()],
        ];
    }
}
