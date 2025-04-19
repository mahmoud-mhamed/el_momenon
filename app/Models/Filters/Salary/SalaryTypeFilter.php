<?php

namespace App\Models\Filters\Salary;

use App\Classes\Filter\Filter;
use App\Classes\Filter\FilterTypeEnum;
use App\Enums\BillPurchaseTypeEnum;
use App\Enums\SalaryTypeEnum;
use Illuminate\Contracts\Support\Arrayable;

final class SalaryTypeFilter extends Filter
{
    public FilterTypeEnum $filterTypeEnum = FilterTypeEnum::DROPDOWN;
    public string $key = 'type';

    public function __construct(public ?\Closure $callback = null)
    {
    }

    public static function getData(): null|Arrayable|array|string
    {
        return SalaryTypeEnum::getOptionsData();
    }
}
