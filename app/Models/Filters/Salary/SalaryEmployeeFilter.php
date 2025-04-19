<?php

namespace App\Models\Filters\Salary;

use App\Classes\Filter\Filter;
use App\Classes\Filter\FilterTypeEnum;
use App\Enums\BillPurchaseTypeEnum;
use App\Enums\SalaryTypeEnum;
use App\Models\Employee;
use Illuminate\Contracts\Support\Arrayable;

final class SalaryEmployeeFilter extends Filter
{
    public FilterTypeEnum $filterTypeEnum = FilterTypeEnum::DROPDOWN;
    public string $key = 'employee_id';
    public bool $isInt = true;

    public function __construct(public ?\Closure $callback = null)
    {
    }

    public static function getData(): null|Arrayable|array|string
    {
        return Employee::query()->whereHas('salaries')->get();
    }
}
