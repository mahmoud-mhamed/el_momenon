<?php

namespace App\Http\Requests;

use App\Enums\SalaryTypeEnum;
use App\Rules\LargeTextRule;
use App\Rules\PriceRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class SalaryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $other_rules = [];
        if ($this->type == SalaryTypeEnum::SALARY->value) {
            $other_rules['month'] = [
                'required', 'integer', 'between:1,12',
                Rule::unique('salaries')
                    ->where('employee_id', $this->employee_id)
                    ->where('type', SalaryTypeEnum::SALARY->value)
                    ->where('deleted_at', null)
                    ->ignore($this->salary?->id ?? null)

            ];
        } else {
            $other_rules['month'] = [
                'required', 'integer', 'between:1,12',
            ];
        }
        return [
            'employee_id' => 'required|exists:employees,id',
            'amount' => ['required', new PriceRule()],
            'type' => ['required', new Enum(SalaryTypeEnum::class)],
            ...$other_rules,
            'note' => ['nullable', new LargeTextRule()],
        ];
    }
}
