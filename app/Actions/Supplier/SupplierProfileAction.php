<?php

namespace App\Actions\Supplier;

use App\Actions\Bill\BillProfileAction;
use App\Actions\Client\ClientIndexAction;
use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\BillPaymentTypeEnum;
use App\Models\Archive;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Models\Client;
use App\Models\Supplier;
use Inertia\Inertia;

class SupplierProfileAction extends BaseAction
{
    public function viewBills(Supplier $supplier): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_SUPPLIER_BILLS);
        $this->setProfileTab('BillTab', $supplier);
        $data['row'] = $supplier;
        $data['bills'] = Bill::query()
            ->with('supplier', 'client', 'disabledClient', 'currency')
            ->where('supplier_id', $supplier->id)
            ->paginate();
        return Inertia::render('Supplier/Profile/Index', compact('data'));
    }

    public function viewBillPayment(Supplier $supplier): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_SUPPLIER_BILL_PAYMENTS);
        $this->setProfileTab('PaymentTab', $supplier);

        $data = BillProfileAction::make()->getFormCreateUpdatePayment(
            bill: null, type: BillPaymentTypeEnum::TO_SUPPLIER,
            supplier_id: $supplier->id
        );
        $data['type'] = BillPaymentTypeEnum::TO_SUPPLIER;

        $data['row'] = $supplier;
        $data['payments'] = BillPayment::query()->where('type', BillPaymentTypeEnum::TO_SUPPLIER)
            ->with('paidCurrency', 'proofArchive')
            ->with('bill', 'bill.currency')
            ->whereRelation('bill', 'supplier_id', $supplier->id)->latest('id')->paginate();

        return Inertia::render('Supplier/Profile/Index', compact('data'));
    }


    public function setProfileTab($tap_component, Supplier &$row, $title = null): void
    {
        $row->loadMissing('currency');
        $row->loadCount('bills');

        $main_data_url = ['label' => $row->name, 'url' => route('dashboard.supplier.profile.view-bills', $row), 'ability' => Abilities::M_SUPPLIER_BILLS];

        if ($title) {
            SupplierIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            SupplierIndexAction::make()->useBreadcrumb([$main_data_url]);
        }
        $this->useTransparent();

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }
}
