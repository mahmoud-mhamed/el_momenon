<?php

namespace App\Actions;

use App\Actions\Bill\BillIndexAction;
use App\Chart\Bill\BillInCurrentYearBarChart;
use App\Chart\Client\ClientInCurrentYearBarChart;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Models\Bill;
use App\Models\Client;
use App\Models\Currency;
use App\Models\Supplier;
use App\Models\User;
use Inertia\Inertia;

class DashboardHomeAction extends BaseAction
{
    public function handle()
    {
        $this->pageTitle(__('message.home'));
        $this->useTransparent();

        $data['users'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::USERS),
            User::query()->count(),
            'pi-users',
            route('dashboard.users.index')
        );
        $data['clients'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::CLIENT),
            Client::query()->count(),
            'pi-users',
            route('dashboard.client.index')
        );

        $data['currencies'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::CURRENCIES),
            Currency::query()->count(),
            'pi-dollar',
            route('dashboard.currency.index')
        );
        $data['suppliers'] = $this->makeStatisticCard(
            ModuleNameEnum::getTrans(ModuleNameEnum::SUPPLIER),
            Supplier::query()->count(),
            'pi-users',
            route('dashboard.supplier.index')
        );

        $bills = null;
        $data['search_key']=request()->get('search');
        if (request()->get('search')) {
            $bills = BillIndexAction::make()->getBillQuery()->paginate();
        }

        $data['bills'] = $bills;

        $data['ClientInCurrentYearBarChart'] = ClientInCurrentYearBarChart::make()->toVue();
        $data['BillInCurrentYearBarChart'] = BillInCurrentYearBarChart::make()->toVue();
        return Inertia::render('Home', compact('data'));
    }
}
