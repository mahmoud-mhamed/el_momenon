<?php

namespace App\Models\Filters\Salary;

use App\Classes\Filter\Filter;
use App\Classes\Filter\FilterTypeEnum;
use App\Enums\BillPurchaseTypeEnum;
use App\Enums\SalaryMonthEnum;
use App\Enums\SalaryTypeEnum;
use Illuminate\Contracts\Support\Arrayable;

final class SalaryMonthFilter extends Filter
{
    public FilterTypeEnum $filterTypeEnum = FilterTypeEnum::DROPDOWN;
    public string $key = 'month';
    public bool $isInt = true;

    public function __construct(public ?\Closure $callback = null)
    {
    }

    public static function getData(): null|Arrayable|array|string
    {
        return SalaryMonthEnum::getOptionsData();
    }
}
