<?php

namespace App\Models\Builders;

use App\Classes\Filter\UseFilter;
use App\Models\Filters\Bill\BillClientFilter;
use App\Models\Filters\Bill\BillPurchaseTypeFilter;
use App\Models\Filters\Bill\BillStatusFilter;
use App\Models\Filters\CreatedAtDateRangeFilter;
use App\Models\Notebook;

/**@mixin Notebook*/
class NotebookBuilder extends BaseBuilder
{
    use UseFilter;
    public function filters(): array
    {
        return [
            new CreatedAtDateRangeFilter(fn($date) => $this->createdAtRange($date)),
        ];
    }

}
