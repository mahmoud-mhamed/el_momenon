<?php

namespace App\Actions\Client;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Models\Client;
use Inertia\Inertia;

class ClientProfileAction extends BaseAction
{
    public function viewMainData(Client $client): \Inertia\Response
    {
        $this->checkAbility(Abilities::M_USERS_MAIN_DATA);
        $this->setProfileTab('MainDataTab', $client);
        $data['row'] = $client;
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
