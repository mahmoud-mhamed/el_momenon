<?php

namespace App\Services;

use App\Enums\BillPaymentTypeEnum;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Models\Supplier;

class SupplierService extends BaseService
{
    public function setCurrentAccount(Supplier|null $supplier): void
    {
        if (!$supplier)
            return;
        $bills = Bill::query()->where('supplier_id', $supplier->id)->sum('purchase_price');

        $sum_payments=BillPayment::query()->where('type',BillPaymentTypeEnum::TO_SUPPLIER)
            ->whereRelation('bill','supplier_id',$supplier->id)->sum('bill_currency_equal_total');

        $supplier->update([
            'current_account' => $bills - $sum_payments,
            'sum_bills_amount' => $bills,
            'sum_paid' => $sum_payments,
        ]);
    }
}
