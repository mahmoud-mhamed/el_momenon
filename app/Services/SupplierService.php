<?php

namespace App\Services;

use App\Enums\BillPaymentTypeEnum;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Models\Supplier;

class SupplierService extends BaseService
{
    public function setCurrentAccount(Supplier $supplier): void
    {
        $bills = Bill::query()->where('supplier_id', $supplier->id)->sum('purchase_price');

        $sum_payments=BillPayment::query()->where('type',BillPaymentTypeEnum::TO_SUPPLIER)->sum('bill_currency_equal_total');

        $supplier->update([
            'current_account' => $bills - $sum_payments,
        ]);
    }
}
