<?php

namespace App\Actions\Bill;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\BillPurchaseTypeEnum;
use App\Models\Supplier;

class BillStoreAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_BILL_CREATE;

    public function handle()
    {
        // ...
    }

    public function viewForm(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $this->checkAbility($this->ability);
        BillIndexAction::make()->useBreadcrumb([
            ['label'=>__('message.add_new')],
        ]);
        $data=$this->getFormCreateUpdateData();
        return inertia('Bill/Create',compact('data'));
    }

    public function getFormCreateUpdateData(): array
    {
        return [
            'form_data' => [
                'suppliers' => Supplier::query()->with('currency')->get(),
                'purchase_types' => BillPurchaseTypeEnum::getOptionsData(),
            ]
        ];
    }
}
