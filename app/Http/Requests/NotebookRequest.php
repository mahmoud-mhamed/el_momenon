<?php

namespace App\Http\Requests;

use App\Enums\NotebookTypeEnum;
use App\Rules\DateFormatCreatedAtRule;
use App\Rules\PriceRule;
use App\Rules\SmallTextRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class NotebookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $other_rule = [];
        $type = request()->get('type');
        if ($type === NotebookTypeEnum::SENDER->value) {
            $other_rule['sender'] = ['required', new SmallTextRule()];
        }
        if ($type === NotebookTypeEnum::RECEIVER->value) {
            $other_rule['recipient'] = ['required', new SmallTextRule()];
        }
        return [
            'date' => ['required', new DateFormatCreatedAtRule()],
            'type' => ['required', new Enum(NotebookTypeEnum::class)],
            'currency_id' => ['required', Rule::exists('currencies', 'id')],
            'currency_amount' => ['required', new PriceRule()],
            'eg_currency_amount' => ['required', new PriceRule()],
            'statement' => ['required', new SmallTextRule()],
            ...$other_rule
        ];
    }
}
