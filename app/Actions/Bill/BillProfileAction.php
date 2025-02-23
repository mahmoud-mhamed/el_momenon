<?php

namespace App\Actions\Bill;

use App\Actions\Client\ClientIndexAction;
use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Archive;
use App\Models\Bill;
use App\Models\Client;
use Inertia\Inertia;

class BillProfileAction extends BaseAction
{
    public function viewMainData(Bill $bill): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_BILL_PROFILE);
        $bill->load('currency','equalCurrency');

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
            ->with('bill')->with('client','disabledClient')
            ->where('bill_id',$bill->id)->get();
        return Inertia::render('Bill/Profile/Index', compact('data'));
    }

    public function setProfileTab($tap_component, Bill &$row, $title = null): void
    {
        $main_data_url = ['label' => $row->name, 'url' => route('dashboard.bill.profile.main_data', $row), 'ability' => Abilities::M_BILL_PROFILE];

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
}
