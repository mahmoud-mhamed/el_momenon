<?php

namespace App\Actions\Client;

use App\Actions\Bill\BillProfileAction;
use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\BillPaymentTypeEnum;
use App\Models\Archive;
use App\Models\Bill;
use App\Models\BillPayment;
use App\Models\Client;
use App\Models\Supplier;
use Inertia\Inertia;

class ClientProfileAction extends BaseAction
{
    public function viewMainData(Client $client): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_CLIENT_PROFILE);
        $this->setProfileTab('MainDataTab', $client);
        $data['row'] = $client;
        return Inertia::render('Client/Profile/Index', compact('data'));
    }

    public function viewBills(Client $client): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_CLIENT_BILLS);
        $this->setProfileTab('BillTab', $client);
        $data['row'] = $client;
        $data['bills'] = Bill::query()->with('currency','supplier', 'client', 'disabledClient')->forClientOrDisabledClient($client->id)->get();
        return Inertia::render('Client/Profile/Index', compact('data'));
    }

    public function viewArchive(Client $client): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_CLIENT_ARCHIVE);
        $this->setProfileTab('ArchiveTab', $client);
        $data['row'] = $client;
        $data['archives'] = Archive::query()
            ->with('bill')->with('client', 'disabledClient')
            ->forClientOrDisabledClient($client->id)->get()->groupBy('bill_id');
        return Inertia::render('Client/Profile/Index', compact('data'));
    }

    public function viewBillPayment(Client $client): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_SUPPLIER_BILL_PAYMENTS);
        $this->setProfileTab('PaymentTab', $client);

        $data = BillProfileAction::make()->getFormCreateUpdatePayment(
            client_id: $client->id
        );

        $data['type'] = BillPaymentTypeEnum::FROM_CLIENT;
        $data['row'] = $client;
        $data['payments'] = BillPayment::query()->where('type', BillPaymentTypeEnum::FROM_CLIENT)
            ->with('paidCurrency', 'proofArchive')
            ->with('bill', 'bill.currency')
            ->whereRelation('bill', 'client_id', $client->id)->latest('id')->paginate();


        return Inertia::render('Client/Profile/Index', compact('data'));
    }

    public function setProfileTab($tap_component, Client &$row, $title = null): void
    {
        $main_data_url = ['label' => $row->name, 'url' => route('dashboard.client.profile.main_data', $row), 'ability' => Abilities::M_CLIENT_PROFILE];

        if ($title) {
            ClientIndexAction::make()->useBreadcrumb([
                $main_data_url,
                ['label' => $title, 'url' => url()->current()]
            ]);
        } else {
            ClientIndexAction::make()->useBreadcrumb([$main_data_url]);
        }
        $this->useTransparent();

        Inertia::share([
            'profile_row' => $row,
            'tap_component' => $tap_component,
        ]);
    }
}
