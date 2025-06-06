<?php

namespace App\Actions\Bill;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\BillPaymentTypeEnum;
use App\Models\Archive;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Models\Currency;
use App\Services\BillService;
use Inertia\Inertia;

class BillProfileAction extends BaseAction
{
    public function viewMainData(Bill $bill): \Inertia\Response
    {
        BillService::make()->setBillPaidAmount($bill);
        $bill->refresh();

        $this->checkAbility(Abilities::M_BILL_PROFILE);
        $bill->load('currency');

        $this->setProfileTab('MainDataTab', $bill);
        $data['row'] = $bill;
        return Inertia::render('Bill/Profile/Index', compact('data'));
    }

    public function viewArchive(Bill $bill): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_BILL_ARCHIVE);
        $this->setProfileTab('ArchiveTab', $bill);
        $data['row'] = $bill;
        $data['archives'] = Archive::query()
            ->with('bill')->with('client')
            ->where('bill_id', $bill->id)->get();
        return Inertia::render('Bill/Profile/Index', compact('data'));
    }

    public function viewPayment(Bill $bill, BillPaymentTypeEnum $type): \Inertia\Response
    {
        if ($type == BillPaymentTypeEnum::FROM_CLIENT)
            $this->checkAbility(Abilities::M_BILL_VIEW_PAYMENT_CLIENT);
        else
            $this->checkAbility(Abilities::M_BILL_VIEW_PAYMENT_SUPPLIER);


        $this->setProfileTab('PaymentTab', $bill);

        $data = $this->getFormCreateUpdatePayment();
        $data['type'] = $type;
        $data['row'] = $bill;
        $data['currencies'] = Currency::query()->get();
        $data['payments'] = BillPayment::query()->where('bill_payments.bill_id', $bill->id)
            ->with('bill', 'bill.currency', 'paidCurrency', 'proofArchive')
            ->latest('id')
            ->where('type', $type)->paginate();


        $data['rent'] = $type == BillPaymentTypeEnum::TO_SUPPLIER ? $bill->supplier_rent_amount : $bill->client_rent_amount;

        return Inertia::render('Bill/Profile/Index', compact('data'));
    }

    public function setProfileTab($tap_component, Bill &$row, $title = null): void
    {
        $row->loadMissing('currency', 'supplier', 'client');
        $main_data_url = ['label' => '#' . $row->id, 'url' => route('dashboard.bill.profile.main_data', $row), 'ability' => Abilities::M_BILL_PROFILE];

        if ($title) {
            BillIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            BillIndexAction::make()->useBreadcrumb([$main_data_url]);
        }
        $this->useTransparent();

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }

    public function getFormCreateUpdatePayment($supplier_id=null,$client_id=null): array
    {
        return [
            'form_data' => [
                'currencies' => Currency::get(),
                'bills' => Bill::query()
                    ->when($supplier_id,fn($z)=>$z->where('supplier_id',$supplier_id))
                    ->when($client_id,fn($z)=>$z->where('client_id',$client_id))
                    ->with('currency')->get(),
            ],
        ];
    }
}
