<?php

namespace App\Models\Builders;

use App\Classes\Filter\UseFilter;
use App\Models\Employee;
use App\Models\Filters\CreatedAtDateRangeFilter;

/**@mixin Employee */
class EmployeeBuilder extends BaseBuilder
{
    use UseFilter;

    public function filters(): array
    {
        return [
            new CreatedAtDateRangeFilter(fn($date) => $this->createdAtRange($date)),
        ];
    }
}
