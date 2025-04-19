<?php

namespace App\Models\Builders;

use App\Classes\Filter\UseFilter;
use App\Models\Expense;
use App\Models\Filters\CreatedAtDateRangeFilter;

/**@mixin Expense*/
class ExpenseBuilder extends BaseBuilder
{
    use UseFilter;

    public function filters(): array
    {
        return [
            new CreatedAtDateRangeFilter(fn($date) => $this->createdAtRange($date)),
        ];
    }
}
