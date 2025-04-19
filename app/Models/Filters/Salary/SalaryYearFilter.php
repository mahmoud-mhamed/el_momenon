<?php

namespace App\Models\Filters\Salary;

use App\Classes\Filter\Filter;
use App\Classes\Filter\FilterTypeEnum;
use App\Enums\BillPurchaseTypeEnum;
use App\Enums\SalaryMonthEnum;
use App\Enums\SalaryTypeEnum;
use Illuminate\Contracts\Support\Arrayable;

final class SalaryYearFilter extends Filter
{
    public FilterTypeEnum $filterTypeEnum = FilterTypeEnum::DROPDOWN;
    public string $key = 'year';
    public bool $isInt = true;

    public function __construct(public ?\Closure $callback = null)
    {
    }

    public static function getData(): null|Arrayable|array|string
    {
        $currentYear = now()->year;
        $startYear = 2025;
        $years = [];
        for ($year = $currentYear; $year >= $startYear; $year--) {
            $years[] = [
                'id' => $year,
                'name' => $year
            ];
        }
        return $years;
    }
}
