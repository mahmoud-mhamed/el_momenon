<?php

namespace App\Actions\Bill;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Models\Bill;
use App\Models\Supplier;
use Inertia\Inertia;

class BillIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_BILL_INDEX;

    public function getBillQuery()
    {
        return Bill::query()
            ->filter()
            ->search([
                'notes', 'policy_number', 'chassis_number','car_type',
                'client.name', 'client.phone','client.national_id',
                'supplier.name', 'supplier.phone',
            ])
            ->with('supplier', 'client','currency');
    }
    public function handle()
    {
        $this->useBreadcrumb();
        $this->allowSearch();
        $query = $this->getBillQuery();

        $this->useFilter(Bill::query()->getFilters());
        $data['rows'] = $query->latest('id')->paginate();
        return Inertia::render('Bill/Index', compact('data'));
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::BILL), 'url' => route('dashboard.bill.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }

}
