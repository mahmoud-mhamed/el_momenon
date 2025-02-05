<?php

namespace App\Actions\Currency;

use App\Classes\Abilities;
use App\Classes\BaseAction;
use App\Enums\ModuleNameEnum;
use App\Models\Currency;
use App\Models\User;
use Inertia\Inertia;

class CurrencyIndexAction extends BaseAction
{
    protected Abilities $ability=Abilities::M_CURRENCIES_INDEX;

    public function handle()
    {
        $this->useBreadcrumb();
        $query = Currency::query();
        $data['rows'] = $query->paginate();
        $data['default_currency'] = Currency::query()->where('is_default',true)->first();
        return Inertia::render('Currency/Index',compact('data'));
    }

    public function useBreadcrumb($append_breadcrumb = []): void
    {
        $this->breadcrumb([
            ['label' => ModuleNameEnum::getTrans(ModuleNameEnum::CURRENCIES), 'url' => route('dashboard.currency.index'), 'ability' => $this->ability],
            ...$append_breadcrumb
        ]);
    }
}
