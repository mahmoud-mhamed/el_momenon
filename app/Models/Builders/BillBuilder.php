<?php

namespace App\Models\Builders;

use App\Classes\Filter\UseFilter;
use App\Models\Bill;
use App\Models\Filters\Bill\BillClientFilter;
use App\Models\Filters\Bill\BillPurchaseTypeFilter;
use App\Models\Filters\Bill\BillStatusFilter;
use App\Models\Filters\CreatedAtDateRangeFilter;

/**@mixin Bill */
class BillBuilder extends BaseBuilder
{
    use UseFilter;

    public function filters(): array
    {
        return [
            new BillClientFilter(fn($value) => $this->forClient($value)),
            new BillStatusFilter(fn($value) => $this->forStatus($value)),
            new BillPurchaseTypeFilter(fn($value) => $this->forPurchaseType($value)),
            new CreatedAtDateRangeFilter(fn($date) => $this->createdAtRange($date)),
        ];
    }

    public function forClient(?int $client_id)
    {
        if (!$client_id)
            return $this;
        return $this->where('client_id', $client_id);
    }
    public function forStatus(?string $value)
    {
        if (!$value)
            return $this;
        return $this->where('status', $value);
    }
    public function forPurchaseType(?string $value)
    {
        if (!$value)
            return $this;
        return $this->where('purchase_type', $value);
    }

}
