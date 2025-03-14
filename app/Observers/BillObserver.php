<?php

namespace App\Observers;

use App\Models\Archive;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Models\Currency;
use App\Services\SupplierService;

class BillObserver
{

    public function creating(Bill $bill)
    {
        $bill->currency_id = $bill->supplier->currency_id;
    }

    /**
     * Handle the Bill "created" event.
     */
    public function created(Bill $bill): void
    {
        SupplierService::make()->setCurrentAccount($bill->supplier);
    }

    /**
     * Handle the Bill "updated" event.
     */
    public function updated(Bill $bill): void
    {
        SupplierService::make()->setCurrentAccount($bill->supplier);
    }

    /**
     * Handle the Bill "deleted" event.
     */
    public function deleted(Bill $bill): void
    {
        Archive::query()->where('archives.bill_id', $bill->id)->delete();
        BillPayment::query()->where('bill_id',$bill?->id)->delete();
        SupplierService::make()->setCurrentAccount($bill->supplier);
    }

    /**
     * Handle the Bill "restored" event.
     */
    public function restored(Bill $bill): void
    {
        SupplierService::make()->setCurrentAccount($bill->supplier);
    }

    /**
     * Handle the Bill "force deleted" event.
     */
    public function forceDeleted(Bill $bill): void
    {
        //
    }
}
