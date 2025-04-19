<?php

namespace App\Models\Builders;

use App\Classes\Filter\UseFilter;
use App\Models\Filters\CreatedAtDateRangeFilter;
use App\Models\Filters\Salary\SalaryEmployeeFilter;
use App\Models\Filters\Salary\SalaryMonthFilter;
use App\Models\Filters\Salary\SalaryTypeFilter;
use App\Models\Filters\Salary\SalaryYearFilter;
use App\Models\Salary;

/**@mixin Salary */
class SalaryBuilder extends BaseBuilder
{
    use UseFilter;

    public function filters(): array
    {
        return [
            new SalaryEmployeeFilter(fn($type) => $this->employee($type)),
            new SalaryTypeFilter(fn($type) => $this->type($type)),
            new SalaryMonthFilter(fn($type) => $this->month($type)),
            new SalaryYearFilter(fn($type) => $this->year($type)),
            new CreatedAtDateRangeFilter(fn($date) => $this->createdAtRange($date)),
        ];
    }

    public function type(?string $value)
    {
        if (!$value)
            return $this;
        return $this->where('type', $value);
    }
    public function month(?string $value)
    {
        if (!$value)
            return $this;
        return $this->where('month', $value);
    }
    public function year(?string $value)
    {
        if (!$value)
            return $this;
        return $this->where('year', $value);
    }
    public function employee(?int $value)
    {
        if (!$value)
            return $this;
        return $this->where('employee_id', $value);
    }
}
