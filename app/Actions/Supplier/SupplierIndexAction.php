<?php

namespace App\Actions\Supplier;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Models\Currency;
use App\Models\Supplier;
use Inertia\Inertia;

class SupplierIndexAction extends BaseAction
{
    protected Abilities $ability = Abilities::M_SUPPLIER_INDEX;

    public function handle()
    {
        $this->useBreadcrumb();
        $query = Supplier::query()
            ->search(['name', 'phone', 'country'])
            ->withCount('bills')
            ->latest('id')
            ->with('currency');

        if ($this->requestIsExport()) {
            return $this->exportExcel($query->get(), [
                'id', 'name', 'phone',
                __('column.currency.name') => 'currency.name',
                'bills_count', 'sum_bills_amount',
                'sum_paid', 'current_account',
                'created_at_text'
            ], 'suppliers');
        }

        $data = $this->getFormCreateUpdateData();
        $this->allowSearch();
        $data['rows'] = $query->paginate();
        return Inertia::render('Supplier/Index', compact('data'));
    }

    public function getFormCreateUpdateData(): array
    {
        return [
            'form_data' => [
                'currencies' => Currency::query()->get(['id', 'name']),
            ]
        ];
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::SUPPLIER), 'url' => route('dashboard.supplier.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }
}
